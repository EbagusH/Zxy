<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'otp_code',
        'expires_at',
        'is_used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    /**
     * Generate kode OTP baru
     */
    public static function generateOtp($email)
    {
        try {
            // Validasi email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Log::error('Invalid email format for OTP generation', ['email' => $email]);
                return null;
            }

            // Hapus OTP lama yang belum digunakan untuk email ini
            self::where('email', $email)
                ->where('is_used', false)
                ->delete();

            // Generate kode OTP 6 digit yang secure
            $otpCode = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

            // Buat OTP baru dengan expired 5 menit
            $otp = self::create([
                'email' => $email,
                'otp_code' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(5),
                'is_used' => false,
            ]);

            Log::info('OTP generated successfully', [
                'email' => $email,
                'expires_at' => $otp->expires_at
            ]);

            return $otp;
        } catch (\Exception $e) {
            Log::error('Failed to generate OTP', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return null;
        }
    }

    /**
     * Verifikasi kode OTP
     */
    public static function verifyOtp($email, $otpCode)
    {
        try {
            // Validasi input
            if (empty($email) || empty($otpCode)) {
                return false;
            }

            // Pastikan OTP code adalah 6 digit
            if (!preg_match('/^[0-9]{6}$/', $otpCode)) {
                return false;
            }

            $otp = self::where('email', $email)
                ->where('otp_code', $otpCode)
                ->where('is_used', false)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if ($otp) {
                // Tandai OTP sebagai sudah digunakan
                $otp->update(['is_used' => true]);

                Log::info('OTP verified successfully', [
                    'email' => $email,
                    'otp_id' => $otp->id
                ]);

                return true;
            }

            Log::warning('OTP verification failed', [
                'email' => $email,
                'provided_code' => $otpCode
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('Error during OTP verification', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Bersihkan OTP yang sudah expired
     */
    public static function cleanExpiredOtps()
    {
        try {
            $deletedCount = self::where('expires_at', '<', Carbon::now())->count();
            self::where('expires_at', '<', Carbon::now())->delete();

            if ($deletedCount > 0) {
                Log::info('Cleaned expired OTPs', ['count' => $deletedCount]);
            }

            return $deletedCount;
        } catch (\Exception $e) {
            Log::error('Error cleaning expired OTPs', [
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }

    /**
     * Check apakah OTP masih valid
     */
    public function isValid()
    {
        return !$this->is_used && $this->expires_at > Carbon::now();
    }

    /**
     * Get remaining seconds until expiration
     */
    public function getRemainingSeconds()
    {
        if ($this->expires_at <= Carbon::now()) {
            return 0;
        }

        return $this->expires_at->diffInSeconds(Carbon::now());
    }

    /**
     * Scope untuk OTP yang masih aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_used', false)
            ->where('expires_at', '>', Carbon::now());
    }

    /**
     * Scope untuk email tertentu
     */
    public function scopeForEmail($query, $email)
    {
        return $query->where('email', $email);
    }
}
