<?php

namespace App\Filament\Resources\ServicePages\Pages;

use App\Filament\Resources\ServicePages\ServicePageResource;
use App\Models\Service;
use App\Services\ActivityLogger;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Htmlable;

class EditServicePage extends EditRecord
{
    protected static string $resource = ServicePageResource::class;

    // 1. Mengubah Judul Paling Atas Halaman
    public function getTitle(): string | Htmlable
    {
        return 'Halaman Layanan';
    }

    // 2. Hilangkan breadcrumb
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
        return 'Halaman Layanan berhasil disimpan';
    }

    // Isi daftar kartu dari tabel layanan (yang tampil di website, urut sesuai halaman)
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

    // Simpan teks halaman + tambah / ubah / hapus layanan sesuai kartu + Catat Audit Log
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $cards = array_values($data['cards'] ?? []);
        unset($data['cards']);

        // Tangkap data halaman sebelum diubah (berdasarkan field yang dikirim form)
        $fieldsToTrack = array_keys($data);
        $before = $record->only($fieldsToTrack);

        DB::transaction(function () use ($record, $data, $cards) {
            $record->update($data);

            $keptIds = [];

            foreach ($cards as $card) {
                $judul   = trim($card['list_title'] ?? '');
                $teks    = trim($card['list_excerpt'] ?? '');
                $foto    = $card['list_photo'] ?? null;
                $foto    = is_array($foto) ? (array_values($foto)[0] ?? null) : $foto;
                $service = ! empty($card['id']) ? Service::find($card['id']) : null;

                if ($service) {
                    // Layanan lama: ubah teks dan foto kartu saja
                    $service->update([
                        'list_title'   => $judul,
                        'list_excerpt' => $teks,
                        'list_photo'   => $foto,
                    ]);
                } else {
                    // Layanan baru
                    $service = Service::create([
                        'title'          => $judul,
                        'slug'           => $this->uniqueSlug($judul),
                        'excerpt'        => $teks,
                        'summary'        => $teks,
                        'subtitle'       => $teks,
                        'standard_intro' => '',
                        'points'         => [],
                        'photo'          => $foto,
                        'list_title'     => $judul,
                        'list_excerpt'   => $teks,
                        'list_photo'     => $foto,
                        'sort_order'     => ((int) Service::max('sort_order')) + 1,
                        'is_active'      => true,
                    ]);
                }

                $keptIds[] = $service->id;
            }

            // Kartu yang dihapus dari daftar
            Service::active()->whereNotIn('id', $keptIds)->get()->each->delete();
        });

        // Ambil data terbaru setelah transaksi berhasil
        $after = $record->fresh()->only($fieldsToTrack);

        // Bandingkan perubahan lalu catat ke audit log
        [$oldDiff, $newDiff] = ActivityLogger::diff($before, $after);

        if (!empty($oldDiff) || !empty($newDiff)) {
            ActivityLogger::log(
                subject: 'Layanan',
                description: 'Memperbarui Halaman Layanan & Daftar Kartu',
                old: $oldDiff,
                new: $newDiff,
            );
        }

        return $record;
    }

    // Muat ulang form supaya kartu baru langsung punya id
    protected function afterSave(): void
    {
        $this->fillForm();
    }

    private function uniqueSlug(string $judul): string
    {
        $base = Str::slug($judul) ?: 'layanan';
        $slug = $base;
        $i    = 2;

        while (Service::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}