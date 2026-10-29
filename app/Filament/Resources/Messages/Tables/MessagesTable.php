<?php

namespace App\Filament\Resources\Messages\Tables;

use App\Models\Message;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Actions\Action;

class MessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Penanda baru / sudah dibaca (tanpa ikon centang)
                TextColumn::make('is_read')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => $state ? 'Dibaca' : 'Baru')
                    ->color(fn ($state): string => $state ? 'gray' : 'primary'),

                // Nama + email di baris bawahnya; pesan yang belum dibaca dicetak tebal
                TextColumn::make('name')
                    ->label('Pengirim')
                    ->description(fn (Message $record): string => $record->email)
                    ->weight(fn (Message $record): ?FontWeight => $record->is_read ? null : FontWeight::Bold)
                    ->searchable(['name', 'email'])
                    ->wrap(),

                TextColumn::make('subject')
                    ->label('Sektor / subjek')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('body')
                    ->label('Cuplikan pesan')
                    ->limit(60)
                    ->color('gray')
                    ->wrap()
                    ->visibleFrom('lg'),

                TextColumn::make('created_at')
                    ->label('Diterima')
                    ->formatStateUsing(fn ($state): string => $state ? $state->translatedFormat('d M Y, H:i') : '-')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50])
            ->filters([
                TernaryFilter::make('is_read')
                    ->label('Status')
                    ->placeholder('Semua pesan')
                    ->trueLabel('Sudah dibaca')
                    ->falseLabel('Belum dibaca'),
            ])
            ->recordActions([
                EditAction::make()->label('Buka'),
                DeleteAction::make(),

                 Action::make('balas')

                ->label('Balas')
                ->icon('heroicon-o-envelope')
                ->color('success')
                ->url(fn ($record) => 'mailto:' . $record->email . '?subject=Balasan dari PT. Naba Technology Solutions')
                ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada pesan masuk')
            ->emptyStateDescription('Pesan dari formulir di halaman Kontak akan muncul di sini.');
    }
}