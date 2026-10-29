<?php

namespace App\Filament\Resources\HomeContents\Pages;

use App\Filament\Resources\HomeContents\HomeContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeContents extends ListRecords
{
    protected static string $resource = HomeContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function mount(): void
{
    parent::mount();

    $record = static::getResource()::getModel()::first();

    if ($record) {
        $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
    }
}
}
