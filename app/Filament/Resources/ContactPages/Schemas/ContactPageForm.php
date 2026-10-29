<?php

namespace App\Filament\Resources\ContactPages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ContactPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Halaman Kontak')
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

                                    ->maxLength(100),

                                TextInput::make('title')
                                    ->label('Judul besar')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('intro')
                                    ->label('Paragraf di bawah judul')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                    // 2. INFORMASI KONTAK & PETA
                    Tab::make('2. Informasi Kontak & Peta')->icon('heroicon-o-phone')->schema([
                        Section::make('Judul di atas kartu-kartu informasi')
                            ->icon('heroicon-o-document-text')
                            ->columns(2)
                            ->schema([
                                TextInput::make('info_title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('info_text')
                                    ->label('Keterangan di bawah judul')
                                    ->rows(3),
                            ]),

                        Section::make('Isi kartu informasi')
                            ->description('')
                            ->icon('heroicon-o-identification')
                            ->columns(2)
                            ->schema([
                                TextInput::make('company_name')
                                    ->label('Nama perusahaan')
                                    ->prefixIcon('heroicon-o-building-office')
                                    ->maxLength(255),

                                TextInput::make('address')
                                    ->label('Alamat kantor')
                                    ->prefixIcon('heroicon-o-map-pin')
                                    ->maxLength(255),

                                TextInput::make('phone')
                                    ->label('Nomor telepon (tampil di kartu)')
                                    ->prefixIcon('heroicon-o-phone')
                                    ->tel()
                                    ->maxLength(50),

                                TextInput::make('whatsapp')
                                    ->label('Nomor WhatsApp (untuk tombol CHAT)')
                                    ->helperText('Format 62 tanpa + dan tanpa spasi. Contoh: 628113383803')
                                    ->prefixIcon('heroicon-o-chat-bubble-left-right')
                                    ->maxLength(50),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->prefixIcon('heroicon-o-envelope')
                                    ->email()
                                    ->maxLength(255),

                                TextInput::make('hours')
                                    ->label('Jam pelayanan')
                                    ->prefixIcon('heroicon-o-clock')
                                    ->maxLength(255),

                                TextInput::make('hours_note')
                                    ->label('Catatan jam pelayanan')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Peta')
                            ->icon('heroicon-o-map')
                            ->schema([
                                TextInput::make('map_embed_url')
                                    ->label('Alamat peta')
                                    ->helperText('Kosongkan untuk memakai peta bawaan.')
                                    ->maxLength(1000),
                            ]),
                    ]),

                    // 3. FORMULIR PESAN
                    Tab::make('3. Formulir Pesan')->icon('heroicon-o-envelope')->schema([
                        Section::make('Teks formulir')
                            ->description('')
                            ->icon('heroicon-o-pencil-square')
                            ->columns(2)
                            ->schema([
                                TextInput::make('form_label')
                                    ->label('Label kecil di atas judul formulir')
                                    ->maxLength(150),

                                TextInput::make('form_title')
                                    ->label('Judul formulir')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('form_intro')
                                    ->label('Paragraf pengantar')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Tombol dan pesan sukses')
                            ->icon('heroicon-o-paper-airplane')
                            ->columns(2)
                            ->schema([
                                TextInput::make('form_button')
                                    ->label('Tulisan tombol kirim')
                                    ->maxLength(100),

                                TextInput::make('form_success')
                                    ->label('Pesan yang tampil setelah berhasil terkirim')
                                    ->maxLength(255),

                                Textarea::make('form_note')
                                    ->label('Catatan kecil di bawah tombol')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                ]),
        ]);
    }
}