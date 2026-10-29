<?php

namespace App\Filament\Resources\GalleryPages;

use App\Filament\Resources\GalleryPages\Pages\CreateGalleryPage;
use App\Filament\Resources\GalleryPages\Pages\EditGalleryPage;
use App\Filament\Resources\GalleryPages\Pages\ListGalleryPages;
use App\Filament\Resources\GalleryPages\Schemas\GalleryPageForm;
use App\Filament\Resources\GalleryPages\Tables\GalleryPagesTable;
use App\Models\GalleryPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class GalleryPageResource extends Resource
{
    protected static ?string $model = GalleryPage::class;

    protected static ?string $navigationLabel = 'Halaman Galeri';
    protected static ?string $modelLabel = 'Halaman Galeri';
    protected static ?string $pluralModelLabel = 'Halaman Galeri';
    protected static ?int $navigationSort = 5;

    // Isi halaman cuma satu, jadi tidak bisa dibuat baru atau dihapus
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    // Klik menu di sidebar langsung masuk ke halaman edit
    public static function getNavigationUrl(): string
    {
        $record = static::getModel()::first();

        return $record
            ? static::getUrl('edit', ['record' => $record])
            : static::getUrl('index');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return GalleryPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GalleryPagesTable::configure($table);
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
            'index' => ListGalleryPages::route('/'),
            'create' => CreateGalleryPage::route('/create'),
            'edit' => EditGalleryPage::route('/{record}/edit'),
        ];
    }
}