<?php

namespace App\Filament\Resources\FooterSettings\Pages;

use App\Filament\Resources\FooterSettings\FooterSettingResource;
use App\Models\FooterSetting;
use Filament\Resources\Pages\ListRecords;

class ListFooterSettings extends ListRecords
{
    protected static string $resource = FooterSettingResource::class;

    // Halaman list tidak dipakai: kalau terbuka, langsung lempar ke halaman edit
    public function mount(): void
    {
        $record = FooterSetting::first();

        if ($record) {
            $this->redirect(FooterSettingResource::getUrl('edit', ['record' => $record]));

            return;
        }

        parent::mount();
    }

    // Hilangkan breadcrumb dan tombol "New Footer"
    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}