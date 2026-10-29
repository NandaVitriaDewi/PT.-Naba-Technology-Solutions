<?php

namespace App\Filament\Resources\HeaderSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HeaderSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('button_label')->label('Tombol navbar'),
                TextColumn::make('updated_at')->label('Terakhir diubah')->dateTime('d M Y H:i'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit navbar'),
            ]);
    }
}