<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Informasi dasar')
                ->description('')
                ->icon('heroicon-o-information-circle')
                ->columns(2)
                ->schema([
                    TextInput::make('title')
                        ->label('Nama Layanan')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('slug')
                        ->label('URL (slug)')
                        ->helperText('')
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    Textarea::make('excerpt')
                        ->label('Teks singkat (kartu di beranda)')
                        ->required()
                        ->rows(3)
                        ->columnSpanFull(),
                ]),

            Section::make('Foto')
                ->icon('heroicon-o-photo')
                ->schema([
                    FileUpload::make('photo')
                        ->label('')
                        ->helperText('')
                        ->image()
                        ->maxSize(4096)
                        ->imagePreviewHeight('200')
                        ->disk('public')
                        ->directory('services')
                        ->visibility('public'),
                ]),

            Section::make('Halaman detail')
                ->description('')
                ->icon('heroicon-o-document-text')
                ->schema([
                    Textarea::make('subtitle')
                        ->label('Teks banner (halaman detail)')
                        ->required()
                        ->rows(3),

                    Textarea::make('summary')
                        ->label('Deskripsi & ruang lingkup pasokan')
                        ->required()
                        ->rows(3),
                ]),

            Section::make('Standar kualitas')
                ->description('')
                ->icon('heroicon-o-shield-check')
                ->schema([
                    Textarea::make('standard_intro')
                        ->label('Kalimat pengantar standar kualitas')
                        ->required()
                        ->rows(3),

                    Repeater::make('points')
                        ->label('Poin standar kualitas')
                        ->grid(2)
                        ->columns(1)
                        ->minItems(1)
                        ->maxItems(4)
                        ->addActionLabel('Tambah poin')
                        ->reorderable(false) // hilangkan panah
                        ->schema([
                            TextInput::make('judul')
                                ->label('Judul')
                                ->required(),

                            Textarea::make('isi')
                                ->label('Isi')
                                ->required()
                                ->rows(4)
                                ->autosize(),
                        ]),
                ]),

            Section::make('Pengaturan tampilan')
                ->icon('heroicon-o-cog-6-tooth')
                ->columns(2)
                ->schema([
                    TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),

                    Toggle::make('is_active')
                        ->label('Tampilkan di website')
                        ->default(true)
                        ->inline(false),
                ]),
        ]);
    }
}