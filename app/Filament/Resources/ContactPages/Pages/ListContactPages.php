<?php

namespace App\Filament\Resources\ContactPages\Pages;

use App\Filament\Resources\ContactPages\ContactPageResource;
use App\Models\ContactPage;
use Filament\Resources\Pages\ListRecords;

class ListContactPages extends ListRecords
{
    protected static string $resource = ContactPageResource::class;

    // Halaman list tidak dipakai: kalau terbuka, langsung lempar ke halaman edit
    public function mount(): void
    {
        $record = ContactPage::first();

        if ($record) {
            $this->redirect(ContactPageResource::getUrl('edit', ['record' => $record]));

            return;
        }

        parent::mount();
    }

    // Hilangkan breadcrumb dan tombol "New Halaman Kontak"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}