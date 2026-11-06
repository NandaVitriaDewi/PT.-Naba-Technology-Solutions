@php
    // Semua isi navbar dibaca dari CMS (Pengaturan Navbar)
    $header = \App\Models\HeaderSetting::current();

    // Cadangan kalau menu di CMS belum terisi
    $menuItems = $header->menu_items ?: [
        ['label' => 'Beranda',      'url' => '/',             'submenu' => false],
        ['label' => 'Tentang Kami', 'url' => '/tentang-kami', 'submenu' => false],
        ['label' => 'Layanan',      'url' => '/layanan',      'submenu' => false],
        ['label' => 'Galeri',       'url' => '/galeri',       'submenu' => false],
    ];

    $nav = collect($menuItems)->map(function ($m) {
        $url = $m['url'] ?? '/';
        return [
            'label'        => $m['label'] ?? '',
            'href'         => $url,
            'active'       => $url === '/'
                                ? request()->is('/')
                                : request()->is(trim($url, '/') . '*'),
        ];
    })->all();

    $tombolLabel = $header->button_label;
    $tombolUrl   = $header->button_url ?: '/kontak';

    // Nama perusahaan diambil dari Halaman Kontak (tab 2); cadangan kalau kosong
    $namaPerusahaan = optional(\App\Models\SiteSetting::current())->company_name ?: 'PT. Naba Technology Solutions';
@endphp

<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-md shadow-sm">
    <div class="wrap flex h-[72px] items-center justify-between lg:h-[77px]">
        {{-- LOGO PERUSAHAAN --}}
        <a href="/" class="flex items-center gap-3">
            <img src="{{ $header->logoUrl() }}" alt="Logo" class="h-9 w-auto lg:h-[44px]">
            <span class="text-sm font-bold sm:text-base lg:text-[18px] text-slate-900 tracking-tight">{{ $namaPerusahaan }}</span>
        </a>

        {{-- MENU DESKTOP --}}
        <nav class="hidden items-center gap-8 lg:flex">
            @foreach ($nav as $item)
                <a href="{{ $item['href'] }}"
                   class="relative text-[15px] font-semibold text-slate-700 hover:text-navy transition {{ $item['active'] ? 'text-navy font-bold after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-full after:bg-navy' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach

            @if (filled($tombolLabel))
                <a href="{{ $tombolUrl }}"
                   class="rounded-xl bg-[#0B1528] px-5 py-2.5 text-[14px] font-bold text-white shadow-sm transition hover:bg-slate-800">
                    {{ $tombolLabel }}
                </a>
            @endif
        </nav>

        {{-- TOMBOL HAMBURGER MOBILE --}}
        <button id="menu-toggle" type="button"
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-800 transition hover:bg-slate-200 focus:outline-none lg:hidden"
                aria-label="Toggle Navigation">
            {{-- Ikon Garis 3 --}}
            <svg id="icon-hamburger" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            {{-- Ikon Silang (X) --}}
            <svg id="icon-close" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- MENU MOBILE --}}
    <nav id="mobile-menu" class="hidden border-t border-slate-100 bg-white/98 backdrop-blur-lg px-4 pt-3 pb-6 shadow-xl lg:hidden">
        <div class="wrap space-y-1.5">
            @foreach ($nav as $item)
                <a href="{{ $item['href'] }}"
                   class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-800 transition hover:bg-slate-50 hover:text-navy {{ $item['active'] ? 'bg-navy/5 text-navy' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach

            {{-- Tombol Mobile --}}
            @if (filled($tombolLabel))
                <div class="pt-3">
                    <a href="{{ $tombolUrl }}" class="flex w-full items-center justify-center rounded-xl bg-[#0B1528] py-3 text-sm font-bold text-white shadow-md transition hover:bg-slate-800">
                        {{ $tombolLabel }}
                    </a>
                </div>
            @endif
        </div>
    </nav>
</header>

{{-- JAVASCRIPT TOGGLE (Cuma buat buka-tutup menu di HP) --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconHamburger = document.getElementById('icon-hamburger');
        const iconClose = document.getElementById('icon-close');

        // Toggle Main Menu Mobile
        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                iconHamburger.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        }
    });
</script>