<?php

namespace App\Services;

use App\Models\OtpCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OtpMail;

class OtpService
{
    /**
     * Generate dan kirim OTP ke email
     */
    public function generateAndSendOtp($email, $userName = 'Admin')
    {
        try {
            // Validasi email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return [
                    'success' => false,
                    'message' => 'Format email tidak valid'
                ];
            }

            // Bersihkan OTP yang expired
            OtpCode::cleanExpiredOtps();

            // Generate OTP baru
            $otp = OtpCode::generateOtp($email);

            if (!$otp) {
                return [
                    'success' => false,
                    'message' => 'Gagal membuat kode OTP'
                ];
            }

            // Kirim email OTP
            Mail::to($email)->send(new OtpMail($otp->otp_code, $userName));

            // Log successful OTP generation
            Log::info('OTP generated and sent', [
                'email' => $email,
                'expires_at' => $otp->expires_at
            ]);

            return [
                'success' => true,
                'message' => 'Kode OTP berhasil dikirim ke email Anda',
                'expires_at' => $otp->expires_at
            ];
        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to send OTP', [
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
     * Verifikasi kode OTP
     */
    public function verifyOtp($email, $otpCode)
    {
        try {
            // Validasi input
            if (empty($email) || empty($otpCode)) {
                return false;
            }

            // Pastikan OTP code adalah 6 digit angka
            if (!preg_match('/^[0-9]{6}$/', $otpCode)) {
                return false;
            }

            $result = OtpCode::verifyOtp($email, $otpCode);

            // Log verification attempt
            Log::info('OTP verification attempt', [
                'email' => $email,
                'success' => $result
            ]);

            return $result;
        } catch (\Exception $e) {
            Log::error('OTP verification error', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Check apakah masih ada OTP yang valid untuk email tertentu
     */
    public function hasValidOtp($email)
    {
        try {
            return OtpCode::where('email', $email)
                ->where('is_used', false)
                ->where('expires_at', '>', now())
                ->exists();
        } catch (\Exception $e) {
            Log::error('Error checking valid OTP', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Get remaining time for OTP expiration
     */
    public function getOtpRemainingTime($email)
    {
        try {
            $otp = OtpCode::where('email', $email)
                ->where('is_used', false)
                ->where('expires_at', '>', now())
                ->orderBy('created_at', 'desc')
                ->first();

            if ($otp) {
                return $otp->expires_at->diffInSeconds(now());
            }

            return 0;
        } catch (\Exception $e) {
            Log::error('Error getting OTP remaining time', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }
}
