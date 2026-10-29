<?php

namespace App\Filament\Resources\ContactPages\Pages;

use App\Filament\Resources\ContactPages\ContactPageResource;
use Filament\Resources\Pages\EditRecord;

class EditContactPage extends EditRecord
{
    protected static string $resource = ContactPageResource::class;

    // Mengubah judul header halaman
    public function getHeading(): string
    {
        return 'Halaman Kontak';
    }

    // Hilangkan breadcrumb "Halaman Kontak > ... > Edit"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // Hilangkan tombol Delete di pojok kanan atas
    protected function getHeaderActions(): array
    {
        return [];
    }

    // Tombol Simpan dan Batal
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan'),
            
            // Tambahan Tombol Batal
            \Filament\Actions\Action::make('cancel')
                ->label('Batal')
                ->color('gray')
                ->url(filament()->getHomeUrl()),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Halaman Kontak berhasil disimpan';
    }
}