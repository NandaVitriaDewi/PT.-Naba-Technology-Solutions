<?php

namespace App\Filament\Resources\AboutPages\Pages;

use App\Filament\Resources\AboutPages\AboutPageResource;
use App\Filament\Concerns\LogsActivityOnSave; 
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditAboutPage extends EditRecord
{
    use LogsActivityOnSave;
    protected static string $resource = AboutPageResource::class;
    protected string $activitySubject = 'Beranda';
    protected string $activityDescription = 'Memperbarui Pengaturan Halaman Beranda';
    protected ?array $oldValues = [];

    
    public function getTitle(): string | Htmlable
    {
        return 'Halaman Tentang Kami';
    }

    // Hilangkan breadcrumb "Halaman Tentang Kami > ... > Edit"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // Hilangkan tombol Delete di pojok kanan atas
    protected function getHeaderActions(): array
    {
        return [];
    }

   // Tombol di bagian bawah form
    protected function getFormActions(): array
    {
        return [
            // 1. Tombol Simpan
            $this->getSaveFormAction()
                ->label('Simpan'),

            // 2. Tombol Batal
            $this->getCancelFormAction()
                ->label('Batal'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Halaman Tentang Kami berhasil disimpan';
    }
}