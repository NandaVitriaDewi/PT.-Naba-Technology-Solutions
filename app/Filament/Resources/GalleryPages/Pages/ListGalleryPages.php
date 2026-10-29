<?php

namespace App\Filament\Resources\GalleryPages\Pages;

use App\Filament\Resources\GalleryPages\GalleryPageResource;
use App\Models\GalleryPage;
use Filament\Resources\Pages\ListRecords;

class ListGalleryPages extends ListRecords
{
    protected static string $resource = GalleryPageResource::class;

    // Halaman list tidak dipakai: kalau terbuka, langsung lempar ke halaman edit
    public function mount(): void
    {
        $record = GalleryPage::first();

        if ($record) {
            $this->redirect(GalleryPageResource::getUrl('edit', ['record' => $record]));

            return;
        }

        parent::mount();
    }

    // Hilangkan breadcrumb dan tombol "New Halaman Galeri"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}