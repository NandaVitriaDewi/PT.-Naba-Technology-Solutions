<?php

namespace App\Filament\Resources\HomeContents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class HomeContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Konten Beranda')
                ->columnSpanFull()
                ->persistTabInQueryString() // tab aktif tidak reset saat simpan / refresh
                ->tabs([

                    // 1. HERO
                    Tab::make('1. Hero')->icon('heroicon-o-home')->schema([
                        Section::make('Teks bagian paling atas')
                            ->description('')
                            ->icon('heroicon-o-pencil-square')
                            ->columns(2)
                            ->schema([
                                TextInput::make('hero_badge')
                                    ->label('Label kecil di atas judul')
                                    ->helperText('')
                                    ->maxLength(255),

                                TextInput::make('hero_button')
                                    ->label('Tulisan tombol biru')
                                    ->maxLength(100),

                                TextInput::make('hero_title')
                                    ->label('Judul besar')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Textarea::make('hero_text')
                                    ->label('Paragraf di bawah judul')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Foto')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                self::foto('hero_image', ''),
                            ]),
                    ]),

                    // 2. STRIP BIRU
                    Tab::make('2. Strip Biru')->icon('heroicon-o-chart-bar')->schema([
                        Section::make('Tiga angka strip biru')
                            ->description('')
                            ->icon('heroicon-o-sparkles')
                            ->schema([
                                Repeater::make('stats')
                                    ->label('')
                                    ->grid(3) // kartu berdampingan
                                    ->minItems(1)
                                    ->maxItems(3)
                                    ->addActionLabel('Tambah angka')
                                    ->reorderable(false) // hilangkan panah
                                    ->deletable(false)   // hilangkan tombol delete
                                    ->collapsible(false)
                                    ->itemLabel(fn (array $state): ?string => $state['value'] ?? 'Angka baru')
                                    ->schema([
                                        TextInput::make('value')
                                            ->label('Kata besar')
                                            ->placeholder('contoh: 2024')
                                            ->required(),
                                        TextInput::make('label')
                                            ->label('Keterangan di bawahnya')
                                            ->placeholder('contoh: Tahun Berdiri')
                                            ->required(),
                                    ]),
                            ]),
                    ]),

                    // 3. TENTANG KAMI
                    Tab::make('3. Tentang Kami')->icon('heroicon-o-building-office')->schema([
                        Section::make('Teks tentang perusahaan')
                            ->description('')
                            ->icon('heroicon-o-document-text')
                            ->columns(2)
                            ->schema([
                                TextInput::make('about_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('about_button')
                                    ->label('Tulisan tombol')
                                    ->maxLength(100),

                                Textarea::make('about_text')
                                    ->label('Paragraf')
                                    ->required()
                                    ->rows(5)
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Foto')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                self::foto('about_image', 'Maksimal 4 MB.'),
                            ]),
                    ]),

                    // 4. KATALOG
                    Tab::make('4. Katalog')->icon('heroicon-o-squares-2x2')->schema([
                        Section::make('Judul bagian katalog produk')
                            ->description('')
                            ->icon('heroicon-o-squares-2x2')
                            ->columns(2)
                            ->schema([
                                TextInput::make('catalog_title')
                                    ->label('Judul besar')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('catalog_button')
                                    ->label('Tulisan tombol biru di bawah kartu')
                                    ->maxLength(150),

                                Textarea::make('catalog_text')
                                    ->label('Paragraf di bawah judul')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                    // 5. ALUR PENGADAAN
                    Tab::make('5. Alur Pengadaan')->icon('heroicon-o-arrow-path')->schema([
                        Section::make('Teks pembuka')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('process_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('process_intro')
                                    ->label('Paragraf di bawah judul')
                                    ->required()
                                    ->rows(3),
                            ]),

                        Section::make('4 Card')
                            ->description('')
                            ->icon('heroicon-o-queue-list')
                            ->schema([
                                Repeater::make('process_steps')
                                    ->label('')
                                    ->grid(2)
                                    ->minItems(1)
                                    ->maxItems(4)
                                    ->addActionLabel('Tambah langkah')
                                    ->reorderable(false)
                                    ->deletable(false)
                                    ->collapsible(false)
                                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Langkah baru')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('Judul langkah')
                                            ->required(),
                                        Textarea::make('text')
                                            ->label('Penjelasan singkat')
                                            ->required()
                                            ->rows(3),
                                    ]),
                            ]),

                        Section::make('Foto')
                            ->icon('heroicon-o-photo')
                            ->columns(2)
                            ->schema([
                                self::foto('process_image_1', 'Foto besar'),
                                self::foto('process_image_2', 'Foto kecil'),
                            ]),
                    ]),

                    // 6. GALERI
                    Tab::make('6. Galeri')->icon('heroicon-o-photo')->schema([
                        Section::make('Dokumentasi')
                            ->description('')
                            ->icon('heroicon-o-photo')
                            ->columns(2)
                            ->schema([
                                TextInput::make('gallery_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('gallery_caption')
                                    ->label('Keterangan di bawah judul')
                                    ->maxLength(255),

                                FileUpload::make('gallery_images')
                                    ->label('Foto dokumentasi (maksimal 4)')
                                    ->image()
                                    ->multiple()
                                    ->reorderable(false) // hilangkan fitur geser urutan
                                    ->maxFiles(4)
                                    ->maxSize(4096)
                                    ->panelLayout('grid')
                                    ->disk('public')
                                    ->directory('home')
                                    ->visibility('public')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                    // 7. AJAKAN
                    Tab::make('7. Ajakan')->icon('heroicon-o-megaphone')->schema([
                        Section::make('Ajakan')
                            ->description('')
                            ->icon('heroicon-o-megaphone')
                            ->columns(2)
                            ->schema([
                                TextInput::make('cta_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('cta_button')
                                    ->label('Tulisan tombol')
                                    ->maxLength(100),

                                Textarea::make('cta_text')
                                    ->label('Paragraf')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull(),
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
            ->directory('home')
            ->visibility('public');
    }
}