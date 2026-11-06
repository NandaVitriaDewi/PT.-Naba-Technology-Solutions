<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Services\ActivityLogService; // <-- Import Service
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class RecentActivityWidget extends Widget
{
    protected int | string | array $columnSpan = 'full';
    protected string $view = 'filament.widgets.recent-activity-widget';

    public string $period = '30';
    public int $limit = 10;
    public array $selectedLogs = [];
    public bool $selectAll = false;

    public function setPeriod(string $period): void
    {
        $this->period = in_array($period, ['7', '30', 'all'], true) ? $period : '30';
        $this->limit = 10;
        $this->selectedLogs = [];
        $this->selectAll = false;
    }

    public function loadMore(): void 
    { 
        $this->limit += 10; 
    }

    public function deleteSelected(): void
    {
        if (empty($this->selectedLogs)) return;

        $count = count($this->selectedLogs);
        
        // Panggil Service buat ngehapus
        ActivityLogService::deleteLogs($this->selectedLogs);
        
        $this->selectedLogs = [];
        $this->selectAll = false;

        Notification::make()
            ->title("{$count} riwayat berhasil dihapus")
            ->success()
            ->send();

        $this->dispatch('$refresh');
    }

    public function toggleSelectAll(): void
    {
        if ($this->selectAll) {
            $this->selectedLogs = collect($this->rows)->pluck('id')->toArray();
        } else {
            $this->selectedLogs = [];
        }
    }

    public function checkSelectAllStatus(): void
    {
        $this->selectAll = count($this->selectedLogs) === count($this->rows);
    }

    // --- TAMPILAN DATA (Manggil Service) ---

    public function getTotalLogsProperty(): int
    {
        // Panggil Service buat ngitung total
        return ActivityLogService::countLogs($this->period);
    }

    public function getRowsProperty(): array
    {
        // Panggil Service buat narik data
        $logs = ActivityLogService::getLogs($this->period, $this->limit);
        $users = $this->usersFor($logs);

        return $logs->map(fn ($log) => [
            'id'          => $log->id,
            'icon'        => $this->iconFor((string) $log->subject),
            'subject'     => $log->subject,
            'description' => $log->description,
            'action'      => $this->actionFor($log),
            'time'        => $log->created_at?->locale('id')->translatedFormat('d M Y, H:i'),
            'ago'         => $log->created_at?->locale('id')->diffForHumans(),
            'user'        => $users[$log->getAttribute('user_id')] ?? null,
        ])->all();
    }

    // --- LOGIKA TAMPILAN (Warna & Ikon) ---

    protected function usersFor(Collection $logs): array
    {
        $ids = $logs->map(fn ($l) => $l->getAttribute('user_id'))->filter()->unique()->values();
        if ($ids->isEmpty()) return [];
        return User::whereIn('id', $ids)->pluck('name', 'id')->all();
    }

    protected function iconFor(string $subject): string
    {
        $s = Str::lower($subject);
        return match (true) {
            Str::contains($s, 'navbar')  => 'heroicon-o-bars-3',
            Str::contains($s, 'beranda') => 'heroicon-o-home',
            Str::contains($s, 'tentang') => 'heroicon-o-information-circle',
            Str::contains($s, 'galeri')  => 'heroicon-o-photo',
            Str::contains($s, 'kontak')  => 'heroicon-o-phone',
            Str::contains($s, 'pesan')   => 'heroicon-o-envelope',
            Str::contains($s, 'footer')  => 'heroicon-o-queue-list',
            Str::contains($s, 'layanan') => 'heroicon-o-briefcase',
            default                      => 'heroicon-o-bolt',
        };
    }

    protected function actionFor($log): array
    {
        $text = Str::lower((string) $log->description);
        if (Str::startsWith($text, ['membuat', 'menambah', 'menambahkan'])) {
            return ['label' => 'Dibuat', 'bg' => '#dcfce7', 'color' => '#166534'];
        }
        if (Str::startsWith($text, ['menghapus'])) {
            return ['label' => 'Dihapus', 'bg' => '#fee2e2', 'color' => '#991b1b'];
        }
        return ['label' => 'Diubah', 'bg' => '#fef3c7', 'color' => '#92400e'];
    }
}