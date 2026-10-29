<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected string $view = 'filament.pages.dashboard';

    // Mengubah teks label menu di sidebar kiri
    protected static ?string $navigationLabel = 'Dashboard'; // Ganti teksnya sesuai keinginan lu, misal: 'Ringkasan'

    // Mengubah judul utama di bagian atas halaman Dasbor
    public function getHeading(): string | Htmlable
    {
        return 'Halaman Dashboard'; 
    }

    // Daftar widget yang tampil di halaman dasbor
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\RecentActivityWidget::class,
        ];
    }
}