<?php

namespace App\Filament\Resources\AboutPages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AboutPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Tentang Kami')
                ->columnSpanFull()
                ->persistTabInQueryString() // tab aktif tidak reset saat simpan / refresh
                ->tabs([

                    // 1. BANNER
                    Tab::make('1. Banner')->icon('heroicon-o-flag')->schema([
                        Section::make('Teks banner')
                            ->description('')
                            ->icon('heroicon-o-pencil-square')
                            ->columns(2)
                            ->schema([
                                TextInput::make('badge')
                                    ->label('Label kecil di atas judul')
                                    ->helperText('')
                                    ->maxLength(100),

                                TextInput::make('title')
                                    ->label('Judul besar')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('intro')
                                    ->label('Paragraf di bawah judul')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),

                    ]),

                    // 2. SEJARAH & DEDIKASI
                    Tab::make('2. Sejarah & Dedikasi')->icon('heroicon-o-clock')->schema([
                        Section::make('Sejarah')
                            ->description('')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('history_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Section::make('Paragraf')
                            ->description('')
                            ->icon('heroicon-o-queue-list')
                            ->schema([
                                Repeater::make('history_paragraphs')
                                    ->label('')
                                    ->hiddenLabel()
                                    ->itemLabel(fn () => null) // Menyembunyikan teks preview di atas kotak
                                    ->grid(2)
                                    ->minItems(1)
                                    ->maxItems(5)
                                    ->addable(false)      // Mematikan tombol tambah item secara total
                                    ->reorderable(false) // Hilangkan panah
                                    ->deletable(false)   // Hilangkan tombol delete
                                    ->collapsible(false)
                                    ->schema([
                                        Textarea::make('text')
                                            ->label('Isi paragraf')
                                            ->required()
                                            ->rows(5),
                                    ]),
                            ]),

                        Section::make('Foto')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                self::foto(
                                    'Tambahkan foto',
                                    ''
                                ),
                            ]),
                    ]),

                    // 3. VISI & MISI
                    Tab::make('3. Visi & Misi')->icon('heroicon-o-eye')->schema([
                        Section::make('Visi')
                            ->icon('heroicon-o-eye')
                            ->schema([
                                TextInput::make('vision_title')
                                    ->label('Judul kartu')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('vision_text')
                                    ->label('Isi visi')
                                    ->required()
                                    ->rows(5),
                            ]),

                        Section::make('Misi')
                            ->icon('heroicon-o-flag')
                            ->schema([
                                TextInput::make('mission_title')
                                    ->label('Judul kartu')
                                    ->required()
                                    ->maxLength(255),

                                Repeater::make('mission_items')
                                    ->label('Poin misi')
                                    ->hiddenLabel()
                                    ->itemLabel(fn () => null)
                                    ->grid(2)
                                    ->minItems(1)
                                    ->maxItems(6)
                                    ->addable(false)
                                    ->reorderable(false)
                                    ->deletable(false)
                                    ->collapsible(false)
                                    ->schema([
                                        Textarea::make('text')
                                            ->label('Isi poin')
                                            ->required()
                                            ->rows(3),
                                    ]),
                            ]),
                    ]),

                    // 4. PRINSIP KERJA
                    Tab::make('4. Prinsip Kerja')->icon('heroicon-o-shield-check')->schema([
                        Section::make('Teks pembuka')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('principles_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('principles_intro')
                                    ->label('Paragraf pengantar')
                                    ->rows(3),
                            ]),

                        Section::make('Kotak prinsip')
                            ->description('Kotak-kotak bernomor di halaman.')
                            ->icon('heroicon-o-shield-check')
                            ->schema([
                                Repeater::make('principles')
                                    ->label('')
                                    ->hiddenLabel()
                                    ->itemLabel(fn () => null)
                                    ->grid(2)
                                    ->minItems(1)
                                    ->maxItems(6)
                                    ->addable(false)
                                    ->reorderable(false)
                                    ->deletable(false)
                                    ->collapsible(false)
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Judul')
                                            ->required(),

                                        Textarea::make('text')
                                            ->label('Isi')
                                            ->required()
                                            ->rows(3),
                                    ]),
                            ]),
                    ]),

                    // 5. AJAKAN
                    Tab::make('5. Ajakan')->icon('heroicon-o-megaphone')->schema([
                        Section::make('Teks ajakan')
                            ->description('')
                            ->icon('heroicon-o-megaphone')
                            ->columns(2)
                            ->schema([
                                TextInput::make('cta_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Textarea::make('cta_text')
                                    ->label('Paragraf')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull(),

                                TextInput::make('cta_button_1')
                                    ->label('Tulisan tombol pertama')
                                    ->maxLength(100),

                                TextInput::make('cta_button_2')
                                    ->label('Tulisan tombol kedua')
                                    ->maxLength(100),
                            ]),
                    ]),
                ]),
        ]);
    }

    // Upload foto yang dipakai berulang
    private static function foto(string $nama, string $label, ?string $bantuan = null): FileUpload
    {
        return FileUpload::make($nama)
            ->label($label)
            ->helperText($bantuan)
            ->image()
            ->maxSize(4096)
            ->imagePreviewHeight('200')
            ->disk('public')
            ->directory('about')
            ->visibility('public');
    }
}