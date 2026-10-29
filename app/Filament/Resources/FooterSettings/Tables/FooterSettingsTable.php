<?php

namespace App\Filament\Resources\FooterSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FooterSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tagline')->label('Tagline footer'),
                TextColumn::make('updated_at')->label('Terakhir diubah')->dateTime('d M Y H:i'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit footer'),
            ]);
    }
}