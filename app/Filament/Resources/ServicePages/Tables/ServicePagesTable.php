<?php

namespace App\Filament\Resources\ServicePages\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicePagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul banner'),
                TextColumn::make('updated_at')->label('Terakhir diubah')->dateTime('d M Y H:i'),
            ])
            ->recordActions([
                EditAction::make()->label('Edit teks halaman'),
            ]);
    }
}