<?php

namespace App\Filament\Resources\FooterSettings;

use App\Filament\Resources\FooterSettings\Pages\CreateFooterSetting;
use App\Filament\Resources\FooterSettings\Pages\EditFooterSetting;
use App\Filament\Resources\FooterSettings\Pages\ListFooterSettings;
use App\Filament\Resources\FooterSettings\Schemas\FooterSettingForm;
use App\Filament\Resources\FooterSettings\Tables\FooterSettingsTable;
use App\Models\FooterSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FooterSettingResource extends Resource
{
    protected static ?string $model = FooterSetting::class;

    protected static ?string $navigationLabel = 'Footer';
    protected static ?string $modelLabel = 'Footer';
    protected static ?string $pluralModelLabel = 'Footer';
    protected static ?int $navigationSort = 8;

    // Isi footer cuma satu, jadi tidak bisa dibuat baru atau dihapus
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

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'tagline';

    public static function form(Schema $schema): Schema
    {
        return FooterSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FooterSettingsTable::configure($table);
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
            'index' => ListFooterSettings::route('/'),
            'create' => CreateFooterSetting::route('/create'),
            'edit' => EditFooterSetting::route('/{record}/edit'),
        ];
    }
}