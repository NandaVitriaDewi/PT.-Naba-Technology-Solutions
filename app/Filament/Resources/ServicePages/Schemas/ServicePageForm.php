<?php

namespace App\Filament\Resources\ServicePages\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ServicePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Halaman Layanan')
                ->columnSpanFull()
                ->persistTabInQueryString()
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
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),
                    ]),

                    // 2. JUDUL DAFTAR
                    Tab::make('2. Judul Daftar')->icon('heroicon-o-list-bullet')->schema([
                        Section::make('Judul di atas kartu-kartu layanan')
                            ->icon('heroicon-o-document-text')
                            ->columns(2)
                            ->schema([
                                TextInput::make('list_title')
                                    ->label('Judul daftar')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('list_text')
                                    ->label('Keterangan di bawah judul')
                                    ->maxLength(255),
                            ]),

                        Section::make('Tulisan di bagian bawah tiap kartu')
                            ->icon('heroicon-o-arrow-right-circle')
                            ->schema([
                                TextInput::make('card_link_text')
                                    ->label('Tulisan link di kartu')
                                    ->required()
                                    ->maxLength(100),
                            ]),
                    ]),

                    // 3. KARTU LAYANAN
                    Tab::make('3. Kartu Layanan')->icon('heroicon-o-squares-2x2')->schema([
                        Section::make('Kartu-kartu layanan di halaman ini')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                Repeater::make('cards')
                                    ->label('')
                                    ->schema([
                                        Hidden::make('id'),
                                        Hidden::make('no'),

                                        TextInput::make('list_title')
                                            ->label('Nama layanan')
                                            ->required()
                                            ->maxLength(255),

                                        Textarea::make('list_excerpt')
                                            ->label('Teks singkat di kartu')
                                            ->required()
                                            ->rows(3),

                                        FileUpload::make('list_photo')
                                            ->label('Foto kartu')
                                            ->helperText('Terbaik berbentuk lebar (sekitar 16:9), maksimal 4 MB. Untuk layanan lama, kosongkan untuk memakai foto kartu beranda.')
                                            ->image()
                                            ->maxSize(4096)
                                            ->imagePreviewHeight('200')
                                            ->disk('public')
                                            ->directory('services')
                                            ->visibility('public'),
                                    ])
                                    ->minItems(1)
                                    ->addable()
                                    ->addActionLabel('Tambah layanan')
                                    ->deletable()
                                    ->deleteAction(
                                        fn (Action $action) => $action
                                            ->requiresConfirmation()
                                            ->modalHeading('Hapus layanan ini?')
                                            ->modalDescription('Layanan akan dihapus permanen dari website, termasuk halaman rincian dan kartunya di beranda. Penghapusan berlaku setelah menekan Simpan.')
                                            ->modalSubmitActionLabel('Ya, hapus')
                                    )
                                    ->reorderable(false)
                                    ->collapsible()
                                    ->collapsed()
                                    ->itemLabel(function (array $state): ?string {
                                        $judul = $state['list_title'] ?? '';

                                        if (! empty($state['no'])) {
                                            return 'Kartu ' . $state['no'] . ': ' . $judul;
                                        }

                                        return $judul ?: 'Layanan baru';
                                    }),
                            ]),
                    ]),

                ]),
        ]);
    }
}