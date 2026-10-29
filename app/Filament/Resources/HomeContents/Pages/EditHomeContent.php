<?php

namespace App\Filament\Resources\HomeContents\Pages;

use App\Filament\Resources\HomeContents\HomeContentResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Concerns\LogsActivityOnSave;

class EditHomeContent extends EditRecord
{
    use LogsActivityOnSave; 
    protected static string $resource = HomeContentResource::class;
    protected string $activitySubject = 'Beranda';
    protected string $activityDescription = 'Memperbarui Pengaturan Halaman Beranda';
    
    protected ?array $oldValues = [];

    
    public function getTitle(): string | Htmlable
    {
        return 'Halaman Beranda';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    // Tidak ada tombol di pojok kanan atas (Delete dihapus)
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
        return 'Beranda berhasil disimpan';
    }
}