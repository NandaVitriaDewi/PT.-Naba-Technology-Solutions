<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingResource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Concerns\LogsActivityOnSave;

class EditFooterSetting extends EditRecord
{
    use LogsActivityOnSave;  
    protected static string $resource = FooterSettingResource::class;
    protected string $activitySubject = 'Beranda';
    protected string $activityDescription = 'Memperbarui Pengaturan Halaman Beranda';

    public function getHeading(): string
    {
        return 'Halaman Footer';
    }

    // Hilangkan breadcrumb "Footer > ... > Edit"
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
        return 'Footer berhasil disimpan';
    }
}