<?php

namespace App\Filament\Resources\HeaderSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class HeaderSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([
            Tabs::make('Navbar')
                ->columnSpanFull()
                ->persistTabInQueryString() // tab aktif tidak reset saat simpan / refresh
                ->tabs([

                    // 1. LOGO
                    Tab::make('1. Logo')->icon('heroicon-o-photo')->schema([
                        Section::make('Logo')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Logo navbar')
                                    ->helperText('Kosongkan untuk memakai logo bawaan.')
                                    ->image()
                                    ->maxSize(2048)
                                    ->imagePreviewHeight('120')
                                    ->disk('public')
                                    ->directory('header')
                                    ->visibility('public'),
                            ]),
                    ]),

                    // 2. MENU & TOMBOL (digabung dalam satu section)
                    Tab::make('2. Menu & Tombol')->icon('heroicon-o-bars-3')->schema([
                        Section::make('Menu')
                            ->icon('heroicon-o-bars-3')
                            ->schema([
                                Repeater::make('menu_items')
                                    ->grid(2)
                                    ->columns(1)
                                    ->addable(false)      // tidak bisa tambah menu
                                    ->deletable(false)    // tidak bisa hapus menu
                                    ->reorderable(false)  // tidak ada panah geser
                                    ->collapsible(false)
                                    ->schema([
                                        TextInput::make('label')
                                            ->label('Tulisan menu')
                                            ->required()
                                            ->maxLength(30),

                                        // Tetap tersimpan, tapi tidak ditampilkan di form
                                        Hidden::make('url'),
                                        Hidden::make('submenu'),
                                    ]),

                                TextInput::make('button_label')
                                    ->label('Tulisan tombol gelap')
                                    ->maxLength(50),

                                // Alamat tujuan tombol tetap tersimpan, tapi tidak ditampilkan di form
                                Hidden::make('button_url'),
                            ]),
                    ]),

                ]),
        ]);
    }
}