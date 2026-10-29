<?php

namespace App\Filament\Resources\HeaderSettings\Pages;

use App\Filament\Resources\HeaderSettings\HeaderSettingResource;
use App\Models\HeaderSetting;
use Filament\Resources\Pages\ListRecords;

class ListHeaderSettings extends ListRecords
{
    protected static string $resource = HeaderSettingResource::class;

    // Data navbar cuma satu, jadi langsung buka form edit (tanpa tabel)
    public function mount(): void
    {
        $record = HeaderSetting::first();

        if ($record) {
            $this->redirect(HeaderSettingResource::getUrl('edit', ['record' => $record]));

            return;
        }

        parent::mount();
    }


    // Tidak ada tombol "New Navbar"
    protected function getHeaderActions(): array
    {
        return [];
    }
}