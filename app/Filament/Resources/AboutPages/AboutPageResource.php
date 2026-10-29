<?php

namespace App\Filament\Resources\AboutPages;

use App\Filament\Resources\AboutPages\Pages\CreateAboutPage;
use App\Filament\Resources\AboutPages\Pages\EditAboutPage;
use App\Filament\Resources\AboutPages\Pages\ListAboutPages;
use App\Filament\Resources\AboutPages\Schemas\AboutPageForm;
use App\Filament\Resources\AboutPages\Tables\AboutPagesTable;
use App\Models\AboutPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AboutPageResource extends Resource
{
    protected static ?string $model = AboutPage::class;

    protected static ?string $navigationLabel = 'Halaman Tentang Kami';
    protected static ?string $modelLabel = 'Halaman Tentang Kami';
    protected static ?string $pluralModelLabel = 'Halaman Tentang Kami';
    protected static ?int $navigationSort = 2;

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

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AboutPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutPagesTable::configure($table);
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
            'index' => ListAboutPages::route('/'),
            'create' => CreateAboutPage::route('/create'),
            'edit' => EditAboutPage::route('/{record}/edit'),
        ];
    }
}