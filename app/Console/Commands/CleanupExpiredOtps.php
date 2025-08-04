<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Log;

class CleanupExpiredOtps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:cleanup {--force : Skip confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup expired OTP codes from database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Hitung jumlah OTP yang akan dihapus
            $expiredCount = OtpCode::where('expires_at', '<', now())->count();

            if ($expiredCount === 0) {
                $this->info('Tidak ada kode OTP yang kadaluarsa untuk dihapus.');
                return Command::SUCCESS;
            }

            // Konfirmasi jika tidak menggunakan --force
            if (!$this->option('force')) {
                if (!$this->confirm("Akan menghapus {$expiredCount} kode OTP yang kadaluarsa. Lanjutkan?")) {
                    $this->info('Operasi dibatalkan.');
                    return Command::FAILURE;
                }
            }

            // Jalankan cleanup
            $deletedCount = OtpCode::cleanExpiredOtps();

            // Log hasil
            Log::info('OTP cleanup executed', [
                'deleted_count' => $deletedCount,
                'executed_at' => now()
            ]);

            $this->info("✅ Berhasil menghapus {$deletedCount} kode OTP yang sudah kadaluarsa.");

            // Tampilkan statistik tambahan
            $activeCount = OtpCode::where('expires_at', '>', now())
                ->where('is_used', false)
                ->count();

            $this->info("📊 Statistik: {$activeCount} kode OTP masih aktif.");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            Log::error('Error during OTP cleanup', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->error('❌ Terjadi kesalahan saat menghapus kode OTP: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
