<?php

namespace App\Filament\Resources\Messages\Pages;

use App\Filament\Resources\Messages\MessageResource;
use App\Services\WhatsAppService; // <-- Import Service-nya
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditMessage extends EditRecord
{
    protected static string $resource = MessageResource::class;

    // Pesan otomatis ditandai "sudah dibaca" saat dibuka
    public function mount(int|string $record): void
    {
        parent::mount($record);

        if (! $this->record->is_read) {
            $this->record->update(['is_read' => true]);
            $this->fillForm();
        }
    }

    public function getTitle(): string
    {
        return 'Pesan dari ' . $this->record->name;
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Hapus pesan')
                ->modalHeading('Hapus pesan ini?')
                ->modalDescription('Pesan akan dihapus permanen dan tidak bisa dikembalikan.'),
        ];
    }

    // TOMBOL DI BAGIAN BAWAH
    protected function getFormActions(): array
    {
        return [
            // 1. Tombol Balas Pesan (Langsung ke WhatsApp)
            Action::make('balas_pesan')
                ->label('Balas Pesan')
                ->icon('heroicon-o-chat-bubble-left-right') 
                ->color('success')
                ->url(function () {
                    // Panggil Service, kirim nomor telepon & pesan otomatisnya
                    return WhatsAppService::generateLink(
                        $this->record->phone,
                        "Halo " . $this->record->name . ", terima kasih sudah menghubungi PT. Naba Technology Solutions. Ada yang bisa kami bantu?"
                    );
                })
                ->openUrlInNewTab(),

            // 2. Tombol Batal (Kembali ke Daftar)
            Action::make('batal')
                ->label('Batal')
                ->color('gray')
                ->url(MessageResource::getUrl('index')),
        ];
    }
}