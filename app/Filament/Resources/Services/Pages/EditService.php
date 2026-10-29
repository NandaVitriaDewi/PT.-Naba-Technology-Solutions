<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Services\ActivityLogger;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected ?array $oldValues = [];

    // 1. Tangkap data sebelum disimpan
    protected function beforeSave(): void
    {
        $this->oldValues = collect($this->record->getAttributes())
            ->except(['id', 'created_at', 'updated_at'])
            ->toArray();
    }

    // 2. Bandingkan dan catat log setelah berhasil disimpan
    protected function afterSave(): void
    {
        $after = collect($this->record->fresh()->getAttributes())
            ->except(['id', 'created_at', 'updated_at'])
            ->toArray();

        [$oldDiff, $newDiff] = ActivityLogger::diff($this->oldValues, $after);

        if (!empty($oldDiff) || !empty($newDiff)) {
            ActivityLogger::log(
                subject: 'Detail Layanan',
                description: 'Memperbarui Detail Item Layanan',
                old: $oldDiff,
                new: $newDiff,
            );
        }
    }

    // 1. Mengubah Judul Paling Atas Halaman
    public function getTitle(): string | Htmlable
    {
        return 'Halaman  Detail Layanan';
    }

    // Hilangkan breadcrumb "Layanan > ... > Edit"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    // 3. Ubah tombol Save changes jadi "Simpan" dan tambahkan tombol "Batal"
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Simpan'),

            $this->getCancelFormAction()
                ->label('Batal'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Layanan berhasil disimpan';
    }
}