<?php

namespace App\Filament\Resources\GalleryPages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class GalleryPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Halaman Galeri')
                ->columnSpanFull()
                ->tabs([

                    // 1. BANNER
                    Tab::make('1. Banner')->icon('heroicon-o-flag')->schema([
                        Section::make('Banner navy atas halaman')
                            ->description('')
                            ->schema([
                                TextInput::make('badge')
                                    ->label('Label kecil di atas judul')
                                    ->maxLength(100),
                                TextInput::make('title')
                                    ->label('Judul besar')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('intro')
                                    ->label('Paragraf di bawah judul')
                                    ->rows(3),
                            ])
                            ->columns(1),
                    ]),

                    // 2. FOTO GALERI
                    Tab::make('2. Foto Galeri')->icon('heroicon-o-photo')->schema([
                        Section::make('Foto dokumentasi')
                            ->description('')
                            ->schema([
                                Repeater::make('photos')
                                    ->label('Foto')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Foto')
                                            ->helperText('Terbaik berbentuk 4:3, misalnya 1200 x 900 px.')
                                            ->image()
                                            ->required()
                                            ->disk('public')
                                            ->directory('galeri')
                                            ->visibility('public'),
                                        TextInput::make('title')
                                            ->label('Keterangan foto')
                                            ->maxLength(255),
                                    ])
                                    ->addActionLabel('Tambah foto')
                                    ->maxItems(24)
                                    ->reorderable()
                                    ->collapsible()
                                    ->collapsed()
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                            ])
                            ->columns(1),
                    ]),

                    // 3. AJAKAN KUNJUNGAN
                    Tab::make('3. Ajakan Kunjungan')->icon('heroicon-o-map-pin')->schema([
                        Section::make('Bagian di bawah foto')
                            ->description('')
                            ->schema([
                                TextInput::make('cta_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('cta_text')
                                    ->label('Paragraf')
                                    ->rows(3),
                                TextInput::make('cta_button')
                                    ->label('Tulisan tombol')
                                    ->maxLength(100),
                                TextInput::make('cta_url')
                                    ->label('Alamat tujuan tombol (opsional)')
                                    ->helperText('')
                                    ->url()
                                    ->maxLength(500),
                            ])
                            ->columns(1),
                    ]),
                ]),
        ]);
    }
}