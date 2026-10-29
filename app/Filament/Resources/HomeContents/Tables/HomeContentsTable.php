<?php

namespace App\Filament\Resources\HomeContents\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomeContentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')->label('Judul Hero'),
                TextColumn::make('updated_at')->label('Terakhir diubah')->dateTime('d M Y H:i'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit isi beranda'),
            ]);
    }
}