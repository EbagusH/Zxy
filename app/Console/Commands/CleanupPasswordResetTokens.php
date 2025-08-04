<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Log;

class CleanupPasswordResetTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password-reset:cleanup {--force : Skip confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup expired password reset tokens from database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Hitung jumlah token yang akan dihapus
            $expiredCount = PasswordResetToken::where('created_at', '<', now()->subHour())->count();

            if ($expiredCount === 0) {
                $this->info('Tidak ada token reset password yang kadaluarsa untuk dihapus.');
                return Command::SUCCESS;
            }

            // Konfirmasi jika tidak menggunakan --force
            if (!$this->option('force')) {
                if (!$this->confirm("Akan menghapus {$expiredCount} token reset password yang kadaluarsa. Lanjutkan?")) {
                    $this->info('Operasi dibatalkan.');
                    return Command::FAILURE;
                }
            }

            // Jalankan cleanup
            $deletedCount = PasswordResetToken::cleanExpiredTokens();

            // Log hasil
            Log::info('Password reset tokens cleanup executed', [
                'deleted_count' => $deletedCount,
                'executed_at' => now()
            ]);

            $this->info("✅ Berhasil menghapus {$deletedCount} token reset password yang sudah kadaluarsa.");

            // Tampilkan statistik tambahan
            $activeCount = PasswordResetToken::where('created_at', '>', now()->subHour())->count();

            $this->info("📊 Statistik: {$activeCount} token reset password masih aktif.");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            Log::error('Error during password reset tokens cleanup', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            $this->error('❌ Terjadi kesalahan saat menghapus token reset password: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
