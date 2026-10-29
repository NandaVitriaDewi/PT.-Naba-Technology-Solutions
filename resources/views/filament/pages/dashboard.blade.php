@php
    // Alamat tujuan = sama persis dengan menu di sidebar (diambil dari Resource masing-masing).
    // Kalau sebuah Resource tidak ditemukan, kartunya mengarah ke '#' (tidak error).
    $url = function (string $resource): string {
        return class_exists($resource) ? $resource::getUrl() : '#';
    };

    // Jumlah pesan yang belum dibaca (angka merah di kartu Pesan Masuk)
    $belumDibaca = class_exists(\App\Models\Message::class)
        ? \App\Models\Message::where('is_read', false)->count()
        : 0;

    $cards = [
        ['label' => 'Navigasi',      'title' => 'Navbar',                  'desc' => 'Pengaturan menu navigasi utama & logo.',    'icon' => 'heroicon-o-bars-3',            'url' => $url(\App\Filament\Resources\HeaderSettings\HeaderSettingResource::class)],
        ['label' => 'Konten',        'title' => 'Halaman Beranda',       'desc' => 'Kelola banner hero & section awal.',         'icon' => 'heroicon-o-home',              'url' => $url(\App\Filament\Resources\HomeContents\HomeContentResource::class)],
        ['label' => 'Profil',        'title' => 'Halaman Tentang Kami', 'desc' => 'Kelola profil, visi, & misi perusahaan.',   'icon' => 'heroicon-o-information-circle','url' => $url(\App\Filament\Resources\AboutPages\AboutPageResource::class)],
        ['label' => 'Layanan',       'title' => 'Halaman Layanan',       'desc' => 'Pengaturan deskripsi umum layanan.',         'icon' => 'heroicon-o-briefcase',         'url' => $url(\App\Filament\Resources\ServicePages\ServicePageResource::class)],
        ['label' => 'Master Data',   'title' => 'Data Layanan',          'desc' => 'Kelola daftar sektor usaha & fitur.',        'icon' => 'heroicon-o-rectangle-stack',   'url' => $url(\App\Filament\Resources\Services\ServiceResource::class)],
        ['label' => 'Media',         'title' => 'Halaman Galeri',        'desc' => 'Kelola galeri foto & dokumentasi.',          'icon' => 'heroicon-o-photo',             'url' => $url(\App\Filament\Resources\GalleryPages\GalleryPageResource::class)],
        ['label' => 'Informasi',     'title' => 'Halaman Kontak',        'desc' => 'Atur nomor telepon, email, & peta.',         'icon' => 'heroicon-o-phone',             'url' => $url(\App\Filament\Resources\ContactPages\ContactPageResource::class)],
        ['label' => 'Interaksi',     'title' => 'Pesan Masuk',           'desc' => 'Lihat & tanggapi pesan pelanggan.',          'icon' => 'heroicon-o-envelope',          'url' => $url(\App\Filament\Resources\Messages\MessageResource::class), 'badge' => $belumDibaca],
        ['label' => 'Bagian Bawah',  'title' => 'Footer',                  'desc' => 'Kelola link footer & hak cipta.',            'icon' => 'heroicon-o-queue-list',        'url' => $url(\App\Filament\Resources\FooterSettings\FooterSettingResource::class)],
    ];
@endphp

<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.5rem; width: 100%;">

        {{-- Banner Utama PT Naba --}}
        <div style="background: linear-gradient(to right, #1e3a8a, #1e40af, #0f172a); padding: 1.5rem; border-radius: 1rem; color: white; position: relative; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="position: relative; z-index: 10; width: 100%; max-width: 42rem;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: rgba(59, 130, 246, 0.2); padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; color: #bfdbfe; border: 1px solid rgba(147, 197, 253, 0.3);">
                    <span style="height: 0.5rem; width: 0.5rem; border-radius: 9999px; background-color: #60a5fa;"></span>
                    CMS Panel Active
                </div>

                <h1 style="margin-top: 0.75rem; font-size: clamp(1.25rem, 4vw, 1.875rem); line-height: 1.25; font-weight: 800;">
                    Selamat Datang di Panel Admin
                </h1>

                <p style="margin-top: 0.5rem; font-size: clamp(0.8125rem, 2vw, 0.875rem); color: rgba(219, 234, 254, 0.9); line-height: 1.5;">
                    Kelola seluruh data dan konten landing page <strong style="color: white;">PT. Naba Technology Solutions</strong> dengan cepat, responsif, dan terorganisir.
                </p>

                <div style="margin-top: 1.25rem;">
                    <a href="{{ url('/') }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: white; padding: 0.5rem 0.875rem; border-radius: 0.75rem; font-size: 0.75rem; font-weight: 700; color: #172554; text-decoration: none; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                        <x-filament::icon icon="heroicon-m-arrow-top-right-on-square" style="width: 1rem; height: 1rem; color: #1d4ed8;" />
                        Pratinjau Website Utama
                    </a>
                </div>
            </div>
        </div>

        {{-- Grid Kartu Quick Akses (tiap kartu menuju halaman yang sama dengan sidebar) --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 220px), 1fr)); gap: 1rem; width: 100%;">
            @foreach ($cards as $card)
                <a href="{{ $card['url'] }}"
                   style="display: flex; flex-direction: column; justify-content: space-between; text-decoration: none; border-radius: 0.75rem; border: 1px solid #e2e8f0; background-color: white; padding: 1.25rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.2s ease;"
                   onmouseover="this.style.borderColor='#3b82f6'; this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)';">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <span style="font-size: 0.70rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">{{ $card['label'] }}</span>

                            <div style="position: relative; border-radius: 0.5rem; background-color: #eff6ff; padding: 0.5rem; color: #2563eb; flex-shrink: 0;">
                                <x-filament::icon :icon="$card['icon']" style="width: 1.25rem; height: 1.25rem;" />

                                @if (($card['badge'] ?? 0) > 0)
                                    <span style="position: absolute; top: -0.4rem; right: -0.4rem; display: flex; align-items: center; justify-content: center; min-width: 1rem; height: 1rem; padding: 0 0.25rem; border-radius: 9999px; background-color: #ef4444; color: white; font-size: 0.625rem; font-weight: 700;">{{ $card['badge'] }}</span>
                                @endif
                            </div>
                        </div>

                        <h3 style="margin-top: 0.75rem; font-size: 1rem; font-weight: 700; color: #1e293b;">{{ $card['title'] }}</h3>
                        <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #64748b; line-height: 1.4;">{{ $card['desc'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- WIDGET RIWAYAT AKTIVITAS ADMIN (7 Hari Terakhir) --}}
        <div style="margin-top: 1rem; width: 100%;">
            @livewire(\App\Filament\Widgets\RecentActivityWidget::class)
        </div>

    </div>
</x-filament-panels::page>