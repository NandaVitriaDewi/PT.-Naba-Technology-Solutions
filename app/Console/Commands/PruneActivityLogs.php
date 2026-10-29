<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Command;

class PruneActivityLogs extends Command
{
    // Nama perintahnya
    protected $signature = 'activity-log:prune';
    protected $description = 'Hapus riwayat aktivitas yang umurnya lebih dari 30 hari';

    public function handle()
    {
        // Hapus data yang dibuat sebelum 30 hari yang lalu
        $deleted = ActivityLog::where('created_at', '<', now()->subDays(30))->delete();

        $this->info("Berhasil menghapus {$deleted} riwayat aktivitas lama.");
    }
}