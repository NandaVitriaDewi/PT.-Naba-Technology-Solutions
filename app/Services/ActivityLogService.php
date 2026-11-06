<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ActivityLogService
{
    // Fungsi buat narik data log berdasarkan filter waktu
    public static function getLogs(string $period, int $limit): Collection
    {
        $query = ActivityLog::query();

        if ($period !== 'all') {
            $query->where('created_at', '>=', now()->subDays((int) $period));
        }

        return $query->latest()->latest('id')
            ->limit($limit)
            ->get()
            ->unique(fn (ActivityLog $log) => implode('|', [
                $log->subject,
                $log->description,
                $log->created_at?->format('Y-m-d H:i:s'),
            ]))
            ->values();
    }

    // Fungsi buat ngitung total log (pake filter unique juga biar sinkron)
    public static function countLogs(string $period): int
    {
        $query = ActivityLog::query();

        if ($period !== 'all') {
            $query->where('created_at', '>=', now()->subDays((int) $period));
        }

        return $query->get()
            ->unique(fn (ActivityLog $log) => implode('|', [
                $log->subject,
                $log->description,
                $log->created_at?->format('Y-m-d H:i:s'),
            ]))
            ->count();
    }

    // Fungsi buat ngehapus log berdasarkan array of IDs
    public static function deleteLogs(array $ids): void
    {
        if (empty($ids)) return;
        ActivityLog::whereIn('id', $ids)->delete();
    }
}