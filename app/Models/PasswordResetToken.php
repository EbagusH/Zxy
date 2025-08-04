<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PasswordResetToken extends Model
{
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Generate password reset token
     */
    public static function generateToken($email)
    {
        try {
            // Validasi email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Log::error('Invalid email format for password reset', ['email' => $email]);
                return null;
            }

            // Hapus token lama
            self::where('email', $email)->delete();

            // Generate token baru
            $token = Str::random(60);

            // Buat token baru
            $resetToken = self::create([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            Log::info('Password reset token generated', [
                'email' => $email,
                'created_at' => $resetToken->created_at
            ]);

            return $resetToken;
        } catch (\Exception $e) {
            Log::error('Failed to generate password reset token', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return null;
        }
    }

    /**
     * Verify token
     */
    public static function verifyToken($email, $token)
    {
        try {
            $resetToken = self::where('email', $email)
                ->where('token', $token)
                ->where('created_at', '>', Carbon::now()->subHour()) // Token berlaku 1 jam
                ->first();

            if ($resetToken) {
                Log::info('Password reset token verified', [
                    'email' => $email
                ]);
                return true;
            }

            Log::warning('Password reset token verification failed', [
                'email' => $email
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('Error during password reset token verification', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Delete token after use
     */
    public static function deleteToken($email)
    {
        try {
            return self::where('email', $email)->delete();
        } catch (\Exception $e) {
            Log::error('Error deleting password reset token', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Clean expired tokens
     */
    public static function cleanExpiredTokens()
    {
        try {
            $deletedCount = self::where('created_at', '<', Carbon::now()->subHour())->count();
            self::where('created_at', '<', Carbon::now()->subHour())->delete();

            if ($deletedCount > 0) {
                Log::info('Cleaned expired password reset tokens', ['count' => $deletedCount]);
            }

            return $deletedCount;
        } catch (\Exception $e) {
            Log::error('Error cleaning expired password reset tokens', [
                'error' => $e->getMessage()
            ]);

            return 0;
        }
    }

    /**
     * Check if token is valid
     */
    public function isValid()
    {
        return $this->created_at > Carbon::now()->subHour();
    }
}
