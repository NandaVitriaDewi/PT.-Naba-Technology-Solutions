<?php

namespace App\Filament\Resources\GalleryPages\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleryPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul halaman'),
                TextColumn::make('updated_at')->label('Terakhir diubah')->dateTime('d M Y H:i'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit halaman'),
            ]);
    }
}