<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Simpan cookie email jika remember dicentang (30 hari)
            if ($request->has('remember')) {
                cookie()->queue('remembered_email', $request->email, 60 * 24 * 30);
            } else {
                cookie()->queue(cookie()->forget('remembered_email'));
            }

            return redirect('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
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

        // Hapus foto lama jika ada
        if ($admin->profile_foto && Storage::disk('public')->exists('foto/' . $admin->profile_foto)) {
            Storage::disk('public')->delete('foto/' . $admin->profile_foto);
        }

        // Simpan foto baru
        $fotoBaru = $request->file('foto')->store('foto', 'public');

        // Simpan nama file ke kolom profile_foto
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
}
