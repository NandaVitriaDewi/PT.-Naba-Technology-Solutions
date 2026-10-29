<?php

namespace App\Filament\Resources\FooterSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class FooterSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Tabs::make('Footer')
                ->columnSpanFull()
                ->persistTabInQueryString() // tab aktif tidak reset saat simpan / refresh
                ->tabs([

                    // 1. PROFIL PERUSAHAAN
                    Tab::make('1. Profil Perusahaan')->icon('heroicon-o-building-office')->schema([
                        Section::make('Logo')
                            ->description('')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Logo footer')
                                    ->helperText('Kosongkan untuk memakai logo bawaan.')
                                    ->image()
                                    ->maxSize(2048)
                                    ->imagePreviewHeight('120')
                                    ->disk('public')
                                    ->directory('footer')
                                    ->visibility('public'),
                            ]),

                        Section::make('Teks profil')
                            ->description('')
                            ->icon('heroicon-o-pencil-square')
                            ->schema([
                                TextInput::make('tagline')
                                    ->label('')
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Paragraf profil')
                                    ->rows(4),
                            ]),

                        Section::make('Badge kecil')
                            ->icon('heroicon-o-tag')
                            ->schema([
                                Repeater::make('badges')
                                    ->label('')
                                    ->grid(2)
                                    ->columns(1)
                                    ->maxItems(5)
                                    ->addActionLabel('Tambah badge')
                                    ->reorderable(false)
                                    ->schema([
                                        TextInput::make('text')
                                            ->label('Tulisan')
                                            ->required(),

                                        Select::make('style')
                                            ->label('Warna')
                                            ->options([
                                                'gelap'  => 'Gelap (transparan)',
                                                'terang' => 'Terang (biru muda)',
                                            ])
                                            ->default('gelap')
                                            ->required(),
                                    ]),
                            ]),
                    ]),

                    // 2. BIDANG LAYANAN
                    Tab::make('2. Bidang Layanan')->icon('heroicon-o-squares-2x2')->schema([
                        Section::make('Daftar layanan')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                TextInput::make('services_title')
                                    ->label('Judul kolom')
                                    ->maxLength(100),
                            ]),
                    ]),

                    // 3. NAVIGASI
                    Tab::make('3. Navigasi')->icon('heroicon-o-link')->schema([
                        Section::make('Judul kolom')
                            ->icon('heroicon-o-pencil-square')
                            ->schema([
                                TextInput::make('nav_title')
                                    ->label('Judul kolom')
                                    ->maxLength(100),
                            ]),

                        Section::make('Link navigasi')
                            ->description('Urutan link bisa digeser dengan panah di kiri kartu.')
                            ->icon('heroicon-o-link')
                            ->schema([
                                Repeater::make('nav_links')
                                    ->label('')
                                    ->grid(2)
                                    ->columns(1)
                                    ->maxItems(8)
                                    ->reorderable()
                                    ->addActionLabel('Tambah link')
                                    ->schema([
                                        TextInput::make('label')
                                            ->label('Tulisan')
                                            ->required(),

                                        TextInput::make('url')
                                            ->label('Alamat tujuan')
                                            ->helperText('Contoh: /tentang-kami')
                                            ->required(),
                                    ]),
                            ]),
                    ]),

                    // 4. KANTOR PUSAT
                    Tab::make('4. Kantor Pusat')->icon('heroicon-o-map-pin')->schema([
                        Section::make('Kontak kantor')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                TextInput::make('office_title')
                                    ->label('Judul kolom')
                                    ->maxLength(100),
                            ]),
                    ]),

                    // 5. BARIS BAWAH
                    Tab::make('5. Baris Bawah')->icon('heroicon-o-document-text')->schema([
                        Section::make('Strip paling bawah footer')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('copyright')
                                    ->label('Tulisan hak cipta')
                                    ->helperText('Simbol © dan tahun ditambahkan otomatis di depannya. Jangan ditulis lagi di sini.')
                                    ->maxLength(255),
                            ]),
                    ]),

                ]),
        ]);
    }
}