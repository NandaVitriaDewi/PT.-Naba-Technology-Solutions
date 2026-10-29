@php
    // Semua isi navbar dibaca dari CMS (Pengaturan Navbar)
    $header = \App\Models\HeaderSetting::current();

    // Cadangan kalau menu di CMS belum terisi
    $menuItems = $header->menu_items ?: [
        ['label' => 'Beranda',      'url' => '/',             'submenu' => false],
        ['label' => 'Tentang Kami', 'url' => '/tentang-kami', 'submenu' => false],
        ['label' => 'Layanan',      'url' => '/layanan',      'submenu' => true],
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
            'has_dropdown' => ! empty($m['submenu']),
        ];
    })->all();

    $tombolLabel = $header->button_label;
    $tombolUrl   = $header->button_url ?: '/kontak';

    // Nama perusahaan diambil dari Halaman Kontak (tab 2); cadangan kalau kosong
    $namaPerusahaan = optional(\App\Models\SiteSetting::current())->company_name ?: 'PT. Naba Technology Solutions';

    // Daftar layanan di dropdown: otomatis dari tabel services
    $layananItems = \App\Models\Service::active()->get();
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
                @if (!empty($item['has_dropdown']))
                    {{-- Dropdown Layanan --}}
                    <div class="relative group">
                        <a href="{{ $item['href'] }}"
                           class="inline-flex items-center gap-1.5 relative text-[15px] font-semibold text-slate-700 hover:text-navy transition {{ $item['active'] ? 'text-navy font-bold after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-full after:bg-navy' : '' }}">
                            {{ $item['label'] }}
                            <svg class="h-4 w-4 transition-transform duration-200 group-hover:rotate-180 text-slate-400 group-hover:text-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>

                        {{-- Box Submenu Dropdown Desktop --}}
                        <div class="absolute left-0 mt-3 w-72 rounded-2xl bg-white p-2 shadow-2xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            @foreach ($layananItems as $sub)
                                <a href="/layanan/{{ $sub->slug }}" class="block rounded-xl px-3.5 py-2.5 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-navy transition-all">
                                    {{ $sub->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['href'] }}"
                       class="relative text-[15px] font-semibold text-slate-700 hover:text-navy transition {{ $item['active'] ? 'text-navy font-bold after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-full after:bg-navy' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endif
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

    {{-- MENU DROPDOWN MOBILE (ELEGANT & CLEAN) --}}
    <nav id="mobile-menu" class="hidden border-t border-slate-100 bg-white/98 backdrop-blur-lg px-4 pt-3 pb-6 shadow-xl lg:hidden">
        <div class="wrap space-y-1.5">
            @foreach ($nav as $item)
                @if (!empty($item['has_dropdown']))
                    {{-- Layanan Accordion Mobile --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50/50 overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3">
                            <a href="{{ $item['href'] }}" class="text-sm font-bold text-slate-800 hover:text-navy">
                                {{ $item['label'] }}
                            </a>
                            <button id="sub-toggle" type="button" class="p-1 text-slate-500 focus:outline-none">
                                <svg id="sub-arrow" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        {{-- Sub-items --}}
                        <div id="sub-menu" class="hidden border-t border-slate-200/60 bg-white px-3 py-2 space-y-1">
                            @foreach ($layananItems as $sub)
                                <a href="/layanan/{{ $sub->slug }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50 hover:text-navy transition">
                                    <span class="h-1.5 w-1.5 rounded-full bg-navy/40"></span>
                                    <span>{{ $sub->title }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['href'] }}"
                       class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-800 transition hover:bg-slate-50 hover:text-navy {{ $item['active'] ? 'bg-navy/5 text-navy' : '' }}">
                        {{ $item['label'] }}
                    </a>
                @endif
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

{{-- JAVASCRIPT TOGGLE --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconHamburger = document.getElementById('icon-hamburger');
        const iconClose = document.getElementById('icon-close');
        const subToggle = document.getElementById('sub-toggle');
        const subMenu = document.getElementById('sub-menu');
        const subArrow = document.getElementById('sub-arrow');

        // Toggle Main Menu
        if (toggleBtn && mobileMenu) {
            toggleBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                iconHamburger.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        }

        // Toggle Submenu Layanan (Accordion)
        if (subToggle && subMenu) {
            subToggle.addEventListener('click', function () {
                subMenu.classList.toggle('hidden');
                subArrow.classList.toggle('rotate-180');
            });
        }
    });
</script>