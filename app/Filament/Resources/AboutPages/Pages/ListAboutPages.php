<?php

namespace App\Filament\Resources\AboutPages\Pages;

use App\Filament\Resources\AboutPages\AboutPageResource;
use App\Models\AboutPage;
use Filament\Resources\Pages\ListRecords;

class ListAboutPages extends ListRecords
{
    protected static string $resource = AboutPageResource::class;

    // Halaman list tidak dipakai: kalau terbuka, langsung lempar ke halaman edit
    public function mount(): void
    {
        $record = AboutPage::first();

        if ($record) {
            $this->redirect(AboutPageResource::getUrl('edit', ['record' => $record]));

            return;
        }

        parent::mount();
    }

    // Tombol "New Halaman Tentang Kami" dihilangkan
    protected function getHeaderActions(): array
    {
        return [];
    }
}