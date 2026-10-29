<?php

namespace App\Filament\Resources\Services\Tables;

use App\Models\Service;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->imageSize(56)
                    ->square(),

                // Nama layanan + alamat URL-nya di baris bawah
                TextColumn::make('title')
                    ->label('Nama Layanan')
                    ->weight(FontWeight::Bold)
                    ->description(fn (Service $record): string => '/layanan/' . $record->slug)
                    ->wrap(),

                TextColumn::make('excerpt')
                    ->label('Teks singkat')
                    ->limit(80)
                    ->color('gray')
                    ->wrap()
                    ->visibleFrom('lg'),

                // Tanpa ikon centang hijau
                TextColumn::make('is_active')
                    ->label('Tampil')
                    ->formatStateUsing(fn ($state): string => $state ? 'Ya' : 'Disembunyikan')
                    ->color(fn ($state): string => $state ? 'gray' : 'warning'),
            ])
            ->defaultSort('sort_order')   // urutan tetap mengikuti kolom "Urutan" di form
            ->paginated(false)            // tanpa "Per page" dan nomor halaman
            ->striped()
            ->emptyStateHeading('Belum ada layanan')
            ->emptyStateDescription('Tambahkan layanan lewat menu Halaman Layanan, tab Kartu Layanan.')
            ->recordActions([
                EditAction::make()->button(),
                DeleteAction::make()->button(),
            ]);
            // Tidak ada toolbarActions, jadi kotak centang pilih-banyak hilang
    }
}