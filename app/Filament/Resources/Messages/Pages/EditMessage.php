<?php

namespace App\Filament\Resources\Messages\Pages;

use App\Filament\Resources\Messages\MessageResource;
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

    // Di pojok kanan atas cuma nyisa Hapus
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
            // Tombol Balas Pesan (Warna Hijau)
            Action::make('balas_pesan')
                ->label('Balas Pesan')
                ->icon('heroicon-o-envelope')
                ->color('success')
                ->url(fn () => 'mailto:' . $this->record->email . '?subject=Balasan dari PT. Naba Technology Solutions')
                ->openUrlInNewTab(),
        ];
    }
}