<?php

namespace App\Filament\Resources\HomeContents;

use App\Filament\Resources\HomeContents\Pages\CreateHomeContent;
use App\Filament\Resources\HomeContents\Pages\EditHomeContent;
use App\Filament\Resources\HomeContents\Pages\ListHomeContents;
use App\Filament\Resources\HomeContents\Schemas\HomeContentForm;
use App\Filament\Resources\HomeContents\Tables\HomeContentsTable;
use App\Models\HomeContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class HomeContentResource extends Resource
{
    protected static ?string $model = HomeContent::class;

    protected static ?string $navigationLabel = 'Halaman Beranda';
    protected static ?string $modelLabel = 'Halaman Beranda';
    protected static ?string $pluralModelLabel = 'Halaman Beranda';
    protected static ?int $navigationSort = 1;

    // Isi beranda cuma satu, jadi tidak bisa dibuat baru atau dihapus
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getNavigationUrl(): string
    {
        $record = static::getModel()::first();

        // Jika record sudah ada, arahkan langsung ke halaman edit.
        // Jika belum ada (misal database kosong), arahkan ke index/list 
        // agar tidak error mencari route 'create' yang dimatikan.
        return $record
            ? static::getUrl('edit', ['record' => $record])
            : static::getUrl('index');
    }

    protected static ?string $recordTitleAttribute = 'hero_title';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return HomeContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeContentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHomeContents::route('/'),
            'create' => CreateHomeContent::route('/create'),
            'edit' => EditHomeContent::route('/{record}/edit'),
        ];
    }
}