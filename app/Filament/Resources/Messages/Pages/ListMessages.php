<?php

namespace App\Filament\Resources\Messages\Pages;

use App\Filament\Resources\Messages\MessageResource;
use Filament\Resources\Pages\ListRecords;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    // Hilangkan breadcrumb "Pesan Masuk > List"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // Hilangkan tombol "New Pesan" (pesan datang dari formulir website, bukan dibuat manual)
    protected function getHeaderActions(): array
    {
        return [];
    }
}