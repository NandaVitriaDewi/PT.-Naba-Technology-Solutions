<?php

namespace App\Filament\Resources\HeaderSettings\Pages;

use App\Filament\Concerns\LogsActivityOnSave;
use App\Filament\Resources\HeaderSettings\HeaderSettingResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditHeaderSetting extends EditRecord
{
    use LogsActivityOnSave;

    protected static string $resource = HeaderSettingResource::class;

    // Label di riwayat aktivitas
    protected string $activitySubject = 'Navbar';
    protected string $activityDescription = 'Memperbarui pengaturan Navbar';

    public function getHeading(): string
    {
        return 'Pengaturan Navbar';
    }

    public function getSubheading(): ?string
    {
        return 'Atur logo, menu, dan tombol yang tampil di bagian atas website.';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    // Menghilangkan tombol "Lihat Website" di pojok kanan atas
    protected function getHeaderActions(): array
    {
        return [];
    }

    // Tombol Simpan & Batal di bagian bawah form
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan'),

            Action::make('cancel')
                ->label('Batal')
                ->color('gray')
                ->url(filament()->getHomeUrl()),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Navbar berhasil disimpan';
    }
}