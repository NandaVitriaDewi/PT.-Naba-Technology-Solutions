<?php

namespace App\Filament\Resources\GalleryPages\Pages;

use App\Filament\Resources\GalleryPages\GalleryPageResource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Concerns\LogsActivityOnSave; 

class EditGalleryPage extends EditRecord
{
    use LogsActivityOnSave;
    protected static string $resource = GalleryPageResource::class;
    protected string $activitySubject = 'Beranda';
    protected string $activityDescription = 'Memperbarui Pengaturan Halaman Beranda';
    protected ?array $oldValues = [];

    public function getHeading(): string
    {
        return 'Halaman Galeri';
    }

    // Hilangkan breadcrumb "Halaman Galeri > ... > Edit"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // Hilangkan tombol Delete di pojok kanan atas
    protected function getHeaderActions(): array
    {
        return [];
    }

    // Tombol Simpan (teks diubah jadi "Simpan") dan Batal
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
        return 'Halaman Galeri berhasil disimpan';
    }
}