<?php

namespace App\Filament\Resources\ServicePages;

use App\Filament\Resources\ServicePages\Pages\CreateServicePage;
use App\Filament\Resources\ServicePages\Pages\EditServicePage;
use App\Filament\Resources\ServicePages\Pages\ListServicePages;
use App\Filament\Resources\ServicePages\Schemas\ServicePageForm;
use App\Filament\Resources\ServicePages\Tables\ServicePagesTable;
use App\Models\ServicePage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ServicePageResource extends Resource
{
    protected static ?string $model = ServicePage::class;

    protected static ?string $navigationLabel = 'Halaman Layanan';
    protected static ?string $modelLabel = 'Halaman Layanan';
    protected static ?string $pluralModelLabel = 'Halaman Layanan';
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

// Klik menu "Halaman Layanan" langsung masuk ke halaman edit
    public static function getNavigationUrl(): string
    {
    $record = static::getModel()::first();

    return $record
        ? static::getUrl('edit', ['record' => $record])
        : static::getUrl('index');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ServicePageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServicePagesTable::configure($table);
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
            'index' => ListServicePages::route('/'),
            'create' => CreateServicePage::route('/create'),
            'edit' => EditServicePage::route('/{record}/edit'),
        ];
    }
}
