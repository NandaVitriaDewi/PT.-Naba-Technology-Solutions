<?php

namespace App\Filament\Resources\ServicePages\Pages;

use App\Filament\Resources\ServicePages\ServicePageResource;
use App\Models\ServicePage;
use Filament\Resources\Pages\ListRecords;

class ListServicePages extends ListRecords
{
    protected static string $resource = ServicePageResource::class;


    public function mount(): void
    {
        $record = ServicePage::first();

        if ($record) {
            $this->redirect(ServicePageResource::getUrl('edit', ['record' => $record]));

            return;
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}