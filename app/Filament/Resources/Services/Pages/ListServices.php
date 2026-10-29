<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    // Hilangkan breadcrumb "Layanan > List"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // Hilangkan tombol "New Layanan" (tambah layanan lewat Halaman Layanan > Kartu Layanan)
    protected function getHeaderActions(): array
    {
        return [];
    }
}