<?php

namespace App\Services;

use App\Models\OtpCode;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\PasswordResetOtpMail;

class PasswordResetService
{
    /**
     * Generate dan kirim OTP untuk reset password
     */
    public function sendPasswordResetOtp($email)
    {
        try {
            // Validasi email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return [
                    'success' => false,
                    'message' => 'Format email tidak valid'
                ];
            }

            // Cek apakah email ada di database users
            $user = User::where('email', $email)->first();
            if (!$user) {
                return [
                    'success' => false,
                    'message' => 'Email tidak terdaftar dalam sistem'
                ];
            }

            // Bersihkan OTP yang expired
            OtpCode::cleanExpiredOtps();
            PasswordResetToken::cleanExpiredTokens();

            // Generate OTP baru
            $otp = OtpCode::generateOtp($email);

            if (!$otp) {
                return [
                    'success' => false,
                    'message' => 'Gagal membuat kode OTP'
                ];
            }

            // Kirim email OTP untuk reset password
            Mail::to($email)->send(new PasswordResetOtpMail($otp->otp_code, $user->name ?? 'Admin'));

            Log::info('Password reset OTP sent', [
                'email' => $email,
                'expires_at' => $otp->expires_at
            ]);

            return [
                'success' => true,
                'message' => 'Kode OTP untuk reset password berhasil dikirim ke email Anda',
                'expires_at' => $otp->expires_at
            ];
        } catch (\Exception $e) {
            Log::error('Failed to send password reset OTP', [
                'email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal mengirim kode OTP. Silakan coba lagi.'
            ];
        }
    }

    /**
     * Verifikasi OTP untuk reset password
     */
    public function verifyPasswordResetOtp($email, $otpCode)
    {
        try {
            // Verifikasi OTP
            $otpValid = OtpCode::verifyOtp($email, $otpCode);

            if ($otpValid) {
                // Generate token untuk reset password
                $resetToken = PasswordResetToken::generateToken($email);

                if ($resetToken) {
                    Log::info('Password reset OTP verified, token generated', [
                        'email' => $email
                    ]);

                    return [
                        'success' => true,
                        'message' => 'Kode OTP berhasil diverifikasi',
                        'token' => $resetToken->token
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Gagal membuat token reset password'
                ];
            }

            return [
                'success' => false,
                'message' => 'Kode OTP tidak valid atau sudah kadaluarsa'
            ];
        } catch (\Exception $e) {
            Log::error('Password reset OTP verification error', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat memverifikasi OTP'
            ];
        }
    }

    /**
     * Reset password
     */
    public function resetPassword($email, $token, $newPassword)
    {
        try {
            // Verifikasi token
            if (!PasswordResetToken::verifyToken($email, $token)) {
                return [
                    'success' => false,
                    'message' => 'Token reset password tidak valid atau sudah kadaluarsa'
                ];
            }

            // Update password user
            $user = User::where('email', $email)->first();
            if (!$user) {
                return [
                    'success' => false,
                    'message' => 'Pengguna tidak ditemukan'
                ];
            }

            $user->password = bcrypt($newPassword);
            $user->save();

            // Hapus token setelah digunakan
            PasswordResetToken::deleteToken($email);

            Log::info('Password successfully reset', [
                'email' => $email
            ]);

            return [
                'success' => true,
                'message' => 'Password berhasil direset. Silakan login dengan password baru Anda.'
            ];
        } catch (\Exception $e) {
            Log::error('Password reset error', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mereset password'
            ];
        }
    }
}
