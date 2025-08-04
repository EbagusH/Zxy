<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Services\OtpService;
use App\Services\PasswordResetService;
use App\Models\User;

class AuthController extends Controller
{
    protected $otpService;
    protected $passwordResetService;

    public function __construct(OtpService $otpService, PasswordResetService $passwordResetService)
    {
        $this->otpService = $otpService;
        $this->passwordResetService = $passwordResetService;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $result = $this->otpService->generateAndSendOtp($credentials['email'], $user->name);

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        $request->session()->put('otp_email', $credentials['email']);
        $request->session()->put('remember_login', $request->boolean('remember'));

        return redirect()->route('otp.verify')->with('success', $result['message']);
    }

    public function showOtpForm()
    {
        if (!session('otp_email')) {
            return redirect()->route('login')->with('error', 'Sesi login telah berakhir. Silakan login ulang.');
        }

        return view('auth.otp-verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6', 'regex:/^[0-9]{6}$/'],
        ], [
            'otp_code.required' => 'Kode OTP wajib diisi.',
            'otp_code.size' => 'Kode OTP harus 6 digit.',
            'otp_code.regex' => 'Kode OTP harus berupa angka.',
        ]);

        $email = session('otp_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Sesi login telah berakhir. Silakan login ulang.');
        }

        if (!$this->otpService->verifyOtp($email, $request->otp_code)) {
            throw ValidationException::withMessages([
                'otp_code' => 'Kode OTP tidak valid atau sudah kadaluarsa.',
            ]);
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }

        Auth::login($user, session('remember_login', false));

        if (session('remember_login')) {
            cookie()->queue('remembered_email', $email, 60 * 24 * 30);
        } else {
            cookie()->queue(cookie()->forget('remembered_email'));
        }

        $request->session()->forget(['otp_email', 'remember_login']);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
    }

    public function resendOtp(Request $request)
    {
        $email = session('otp_email');
        if (!$email) {
            return redirect()->route('login')->with('error', 'Sesi login telah berakhir. Silakan login ulang.');
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'User tidak ditemukan.');
        }

        $result = $this->otpService->generateAndSendOtp($email, $user->name);

        if ($result['success']) {
            return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
        }

        return back()->with('error', $result['message']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

    public function showAdminProfile()
    {
        $admin = Auth::user();

        if ($admin->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('dashboard.detail-admin', compact('admin'));
    }

    public function updateFoto(Request $request)
    {
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($admin->profile_foto && Storage::disk('public')->exists('foto/' . $admin->profile_foto)) {
            Storage::disk('public')->delete('foto/' . $admin->profile_foto);
        }

        $fotoBaru = $request->file('foto')->store('foto', 'public');
        $admin->profile_foto = basename($fotoBaru);
        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Password berhasil diubah.');
    }

    // ==================== PASSWORD RESET METHODS ====================

    /**
     * Tampilkan form permintaan reset password
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim OTP untuk reset password
     */
    public function sendPasswordResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid'
        ]);

        $result = $this->passwordResetService->sendPasswordResetOtp($request->email);

        if ($result['success']) {
            // Simpan email di session untuk proses selanjutnya
            session(['password_reset_email' => $request->email]);

            // Redirect ke halaman verifikasi OTP (bukan langsung ke reset password)
            return redirect()->route('password.otp.verify')
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Tampilkan form verifikasi OTP reset password
     */
    public function showPasswordResetOtpForm()
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request')
                ->with('error', 'Sesi tidak valid. Silakan mulai ulang proses reset password.');
        }

        return view('auth.password-reset-otp');
    }

    /**
     * Verifikasi OTP reset password
     */
    public function verifyPasswordResetOtp(Request $request)
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request')
                ->with('error', 'Sesi tidak valid. Silakan mulai ulang proses reset password.');
        }

        $request->validate([
            'otp_code' => 'required|string|size:6|regex:/^[0-9]{6}$/'
        ], [
            'otp_code.required' => 'Kode OTP wajib diisi',
            'otp_code.size' => 'Kode OTP harus 6 digit',
            'otp_code.regex' => 'Kode OTP harus berupa angka'
        ]);

        $email = session('password_reset_email');
        $result = $this->passwordResetService->verifyPasswordResetOtp($email, $request->otp_code);

        if ($result['success']) {
            // Simpan token di session setelah OTP berhasil diverifikasi
            session(['password_reset_token' => $result['token']]);

            // Redirect ke halaman reset password
            return redirect()->route('password.reset.form')
                ->with('success', 'OTP berhasil diverifikasi. Silakan buat password baru.');
        }

        return back()->with('error', $result['message'])->withInput();
    }

    /**
     * Kirim ulang OTP reset password
     */
    public function resendPasswordResetOtp()
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request')
                ->with('error', 'Sesi tidak valid. Silakan mulai ulang proses reset password.');
        }

        $email = session('password_reset_email');
        $result = $this->passwordResetService->sendPasswordResetOtp($email);

        if ($result['success']) {
            return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
        }

        return back()->with('error', $result['message']);
    }

    /**
     * Tampilkan form reset password
     */
    public function showPasswordResetForm()
    {
        // Pastikan ada email dan token di session
        if (!session('password_reset_email') || !session('password_reset_token')) {
            return redirect()->route('password.request')
                ->with('error', 'Sesi tidak valid. Silakan mulai ulang proses reset password.');
        }

        return view('auth.reset-password');
    }

    /**
     * Proses reset password
     */
    public function resetPassword(Request $request)
    {
        if (!session('password_reset_email') || !session('password_reset_token')) {
            return redirect()->route('password.request')
                ->with('error', 'Sesi tidak valid. Silakan mulai ulang proses reset password.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ], [
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi'
        ]);

        $email = session('password_reset_email');
        $token = session('password_reset_token');

        $result = $this->passwordResetService->resetPassword($email, $token, $request->password);

        if ($result['success']) {
            // Hapus semua session terkait reset password
            session()->forget(['password_reset_email', 'password_reset_token']);

            return redirect()->route('login')
                ->with('success', $result['message']);
        }

        return back()->with('error', $result['message']);
    }
}
