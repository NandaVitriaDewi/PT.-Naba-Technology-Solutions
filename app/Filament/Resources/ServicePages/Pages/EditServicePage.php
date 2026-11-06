<?php

namespace App\Filament\Resources\ServicePages\Pages;

use App\Filament\Concerns\LogsActivityOnSave;
use App\Filament\Resources\ServicePages\ServicePageResource;
use App\Models\Service;
use App\Services\ServicePageManager; // Import Service Manager
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;

class EditServicePage extends EditRecord
{
    use LogsActivityOnSave;

    protected static string $resource = ServicePageResource::class;

    protected string $activitySubject = 'Layanan';
    protected string $activityDescription = 'Memperbarui Halaman Layanan & Daftar Kartu';

    public function getTitle(): string | Htmlable
    {
        return 'Halaman Layanan';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Simpan'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Halaman Layanan berhasil disimpan';
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['cards'] = Service::active()
            ->orderBy('id')
            ->get()
            ->values()
            ->map(fn (Service $s, int $i) => [
                'id'           => $s->id,
                'no'           => $i + 1,
                'list_title'   => $s->list_title ?: $s->title,
                'list_excerpt' => $s->list_excerpt ?: $s->excerpt,
                'list_photo'   => $s->list_photo,
            ])
            ->all();

        return $data;
    }

    // LOGIKANYA UDAH DIPINDAHIN KE SERVICE MANAGER
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $cards = array_values($data['cards'] ?? []);
        unset($data['cards']);

        // Simpan data halaman (teks utama)
        $record->update($data);

        // Panggil Service buat nyinkronin kartu
        ServicePageManager::syncCards($cards);

        return $record;
    }

    protected function afterSave(): void
    {
        $this->fillForm();
    }
}