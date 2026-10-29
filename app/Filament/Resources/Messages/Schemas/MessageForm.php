<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(1)->components([

            Section::make('Data pengirim')
                ->description('Diisi oleh pengunjung lewat formulir di halaman Kontak.')
                ->icon('heroicon-o-user')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Nama / instansi')
                        ->prefixIcon('heroicon-o-building-office')
                        ->disabled(),

                    TextInput::make('subject')
                        ->label('Sektor / subjek kebutuhan')
                        ->prefixIcon('heroicon-o-tag')
                        ->disabled(),

                    TextInput::make('email')
                        ->label('Email')
                        ->prefixIcon('heroicon-o-envelope')
                        ->disabled(),

                    TextInput::make('phone')
                        ->label('Telepon / WhatsApp')
                        ->prefixIcon('heroicon-o-phone')
                        ->disabled(),
                ]),

            Section::make('Isi pesan')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->schema([
                    Textarea::make('body')
                        ->label('Rincian kebutuhan')
                        ->rows(8)
                        ->disabled(),
                ]),
                
            // Bagian Status udah dihapus dari sini bro
        ]);
    }
}