<?php

namespace App\Filament\Resources\ContactPages;

use App\Filament\Resources\ContactPages\Pages\CreateContactPage;
use App\Filament\Resources\ContactPages\Pages\EditContactPage;
use App\Filament\Resources\ContactPages\Pages\ListContactPages;
use App\Filament\Resources\ContactPages\Schemas\ContactPageForm;
use App\Filament\Resources\ContactPages\Tables\ContactPagesTable;
use App\Models\ContactPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContactPageResource extends Resource
{
    protected static ?string $model = ContactPage::class;

    protected static ?string $navigationLabel = 'Halaman Kontak';
    protected static ?string $modelLabel = 'Halaman Kontak';
    protected static ?string $pluralModelLabel = 'Halaman Kontak';
    protected static ?int $navigationSort = 6;

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

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ContactPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactPagesTable::configure($table);
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
            'index' => ListContactPages::route('/'),
            'create' => CreateContactPage::route('/create'),
            'edit' => EditContactPage::route('/{record}/edit'),
        ];
    }
}