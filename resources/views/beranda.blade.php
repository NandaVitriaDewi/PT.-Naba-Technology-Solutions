@extends('layouts.frontend')

@section('title', 'Beranda | PT. Naba Technology Solutions')

@section('content')

{{-- 1. HERO --}}
<section class="relative isolate overflow-hidden py-12 sm:py-16 lg:pb-[70px] lg:pt-[28px] xl:pb-[80px] xl:pt-[32px]">

    {{-- Gradasi biru di pojok kanan atas (hiasan saja) --}}
    <div aria-hidden="true"
         class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(ellipse_55%_80%_at_100%_0%,rgba(0,33,87,0.14),transparent_70%),radial-gradient(ellipse_35%_50%_at_96%_8%,rgba(107,138,190,0.20),transparent_70%)]"></div>

    <div class="wrap grid items-center gap-10 lg:grid-cols-[1fr_380px] lg:gap-12 xl:grid-cols-[1fr_474px] xl:gap-[80px]">
        <div>
            @if ($home->hero_badge)
                <span class="inline-flex items-center gap-2 rounded-full border border-navy/15 bg-navy/5 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide text-navy sm:text-xs">
                    <span class="size-2 rounded-full bg-navy"></span>
                    {{ $home->hero_badge }}
                </span>
            @endif

            <h1 class="mt-5 text-[36px] font-bold leading-[1.1] tracking-tight sm:text-[48px] lg:text-[46px] xl:text-[60px]">{{ $home->hero_title }}</h1>
            <p class="mt-6 max-w-[580px] text-base leading-relaxed sm:text-lg">{{ $home->hero_text }}</p>

            @if ($home->hero_button)
                <a href="#katalog" class="mt-9 inline-flex items-center gap-2.5 rounded-[10px] bg-navy px-7 py-3.5 text-[17px] font-semibold text-white transition hover:bg-navy-deep">
                    {{ $home->hero_button }} <span aria-hidden="true">→</span>
                </a>
            @endif
        </div>

        {{-- Foto + logo di pojok kanan atas --}}
        <div class="relative">
            <img src="{{ $home->image('hero_image', 'hero.jpg') }}" alt="{{ $home->hero_title }}" class="card-shadow aspect-[4/3] w-full rounded-[18px] object-cover lg:aspect-[474/480]">
            <div class="absolute right-4 top-4 flex size-[52px] items-center justify-center rounded-[14px] bg-white p-1.5 shadow-lg sm:size-[58px] xl:right-6 xl:top-6 xl:size-[62px]">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo PT. Naba Technology Solutions" class="size-full object-contain">
            </div>
        </div>
    </div>
</section>

{{-- 2. STATISTIK --}}
<section class="bg-navy py-5 text-white lg:py-[22px] xl:py-[26px]">
    <div class="wrap grid grid-cols-3 gap-2 text-center">
        @foreach ($home->stats ?? [] as $stat)
            <div>
                <p class="text-base font-bold sm:text-xl lg:text-2xl xl:text-[27px]">{{ $stat['value'] ?? '' }}</p>
                <p class="text-[11px] font-bold leading-tight sm:text-sm lg:text-xl xl:text-[22px]">{{ $stat['label'] ?? '' }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- 3. TENTANG --}}
<section class="py-14 lg:py-[100px] xl:py-[110px]">
    <div class="wrap grid items-center gap-10 lg:grid-cols-2 lg:gap-14 xl:gap-[80px]">
        <img src="{{ $home->image('about_image', 'tentang-mitra.jpg') }}" alt="{{ $home->about_title }}" class="card-shadow aspect-[497/331] w-full rounded-[18px] object-cover">

        <div class="max-w-[640px]">
            <h2 class="text-[26px] font-bold leading-[1.2] sm:text-[30px] lg:text-[34px] xl:text-[38px]">{{ $home->about_title }}</h2>
            <p class="mt-5 text-base leading-[1.5] sm:text-lg xl:text-[20px]">{{ $home->about_text }}</p>

            @if ($home->about_button)
                <a href="/kontak" class="mt-8 inline-flex items-center gap-2.5 rounded-[10px] bg-navy px-7 py-3.5 text-[17px] font-semibold text-white transition hover:bg-navy-deep">
                    {{ $home->about_button }} <span aria-hidden="true">→</span>
                </a>
            @endif
        </div>
    </div>
</section>

{{-- 4. KATALOG PRODUK --}}
<section id="katalog" class="relative isolate overflow-hidden py-14 lg:py-[100px] xl:py-[110px]">
    <img src="{{ asset('assets/img/katalog-bg.jpg') }}" alt="" class="absolute inset-0 -z-20 size-full object-cover object-bottom">
    <div class="absolute inset-0 -z-10 bg-white/[.67]"></div>

    <div class="wrap">
        <h2 class="text-[32px] font-bold lg:text-[40px] xl:text-[46px]">{{ $home->catalog_title }}</h2>
        <p class="mt-2 max-w-[732px] text-sm sm:text-base xl:max-w-[840px] xl:text-[18px]">{{ $home->catalog_text }}</p>

        <div class="mt-10 grid gap-8 md:grid-cols-2 lg:mt-[44px] lg:grid-cols-3 lg:gap-x-[51px] lg:gap-y-[84px] xl:mt-[50px] xl:gap-x-[58px] xl:gap-y-[90px]">
            @foreach ($services as $service)
                @if ($loop->first)
                    {{-- Kartu besar (layanan urutan pertama) --}}
                    <a href="/layanan/{{ $service->slug }}" class="card-shadow group relative flex min-h-[340px] overflow-hidden rounded-[18px] md:col-span-2 lg:min-h-[439px] xl:min-h-[500px]">
                        <img src="{{ $service->photo_url }}" alt="" class="absolute inset-0 size-full object-cover">
                        <div class="absolute inset-0 bg-linear-to-b from-navy/30 to-navy/80"></div>
                        <div class="relative mt-auto p-6 text-white sm:p-8 lg:px-[38px] lg:pb-[55px] xl:px-[43px] xl:pb-[62px]">
                            <h3 class="max-w-[553px] text-2xl font-bold sm:text-3xl lg:text-4xl xl:max-w-[630px] xl:text-[41px]">{{ $service->title }}</h3>
                            <p class="mt-4 max-w-[547px] text-sm sm:text-base xl:mt-5 xl:max-w-[620px] xl:text-[18px]">{{ $service->excerpt }}</p>
                            <span class="mt-6 inline-block rounded-lg bg-white/10 px-5 py-4 text-base font-bold backdrop-blur-sm transition group-hover:bg-white/20 xl:mt-7 xl:px-6 xl:py-[18px] xl:text-[19px]">
                                Lihat Spesifikasi &amp; Penawaran
                            </span>
                        </div>
                    </a>
                @else
                    {{-- Kartu kecil --}}
                    <a href="/layanan/{{ $service->slug }}" class="card-shadow flex flex-col overflow-hidden rounded-[18px] bg-white">
                        <img src="{{ $service->photo_url }}" alt="{{ $service->title }}" class="aspect-[323/211] w-full object-cover">
                        <div class="flex flex-1 flex-col px-7 pb-6 pt-7 lg:px-9 xl:px-[41px] xl:pb-7 xl:pt-[33px]">
                            <h3 class="text-sm font-bold xl:text-base">{{ $service->title }}</h3>
                            <p class="mt-3 text-sm xl:text-base">{{ $service->excerpt }}</p>
                            <div class="mt-auto pt-5 xl:pt-6">
                                <div class="border-t border-line pt-3">
                                    <span class="inline-flex items-center gap-2 text-[13px] font-bold text-navy xl:text-[15px]">
                                        Rincian &amp; Spesifikasi <span aria-hidden="true">→</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>

        @if ($home->catalog_button)
            <div class="mt-12 text-center lg:mt-[84px] xl:mt-[90px]">
                <a href="/layanan" class="inline-block rounded-lg bg-navy px-8 py-5 text-lg font-bold text-white transition hover:bg-navy-deep sm:text-xl lg:px-[21px] lg:py-6 lg:text-2xl xl:px-6 xl:py-7 xl:text-[27px]">
                    {{ $home->catalog_button }}
                </a>
            </div>
        @endif
    </div>
</section>

{{-- 5. ALUR PENGADAAN --}}
<section class="py-14 lg:py-16">
    <div class="wrap grid items-center gap-10 lg:grid-cols-2 lg:gap-12 xl:gap-16">

        {{-- Foto (kiri): besar di kiri, kecil di kanan --}}
        <div class="flex items-end justify-between">
            <img src="{{ $home->image('process_image_1', 'alur-1.jpg') }}" alt="Tim berdiskusi"
                 class="card-shadow aspect-[478/398] w-[65.7%] rounded-[18px] object-cover">
            <img src="{{ $home->image('process_image_2', 'alur-2.jpg') }}" alt="Diskusi kebutuhan"
                 class="card-shadow aspect-[228/318] w-[31.3%] translate-y-2 rounded-[18px] object-cover">
        </div>

        {{-- Teks (kanan) --}}
        <div>
            <h2 class="text-2xl font-bold leading-tight sm:text-[28px] xl:text-[32px]">{{ $home->process_title }}</h2>
            <p class="mt-3 text-base leading-relaxed xl:text-[17px]">{{ $home->process_intro }}</p>

            <div class="mt-5 grid gap-3 sm:grid-cols-2 xl:gap-[14px]">
                @foreach ($home->process_steps ?? [] as $step)
                    <div class="rounded-[18px] bg-navy/5 p-4">
                        <span class="mx-auto flex h-[18px] w-6 items-center justify-center rounded-[5px] bg-steel text-[10px] font-bold text-white">{{ $loop->iteration }}</span>
                        <h3 class="mt-2.5 text-sm font-bold leading-snug">{{ $step['title'] ?? '' }}</h3>
                        <p class="mt-1 text-xs leading-[1.45]">{{ $step['text'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- 6. GALERI DOKUMENTASI --}}
<section class="bg-navy/[.06] py-14 lg:py-[100px] xl:py-[110px]">
    <div class="wrap">
        <h2 class="text-2xl font-bold sm:text-[28px] lg:text-[32px] xl:text-[36px]">{{ $home->gallery_title }}</h2>

        @if ($home->gallery_caption)
            <p class="mt-4 inline-block rounded bg-navy/90 px-2 py-1.5 text-base text-white lg:text-[17px] xl:px-3 xl:text-[19px]">
                {{ $home->gallery_caption }}
            </p>
        @endif

        <div class="mt-8 grid grid-cols-2 gap-4 lg:mt-12 lg:grid-cols-4 lg:gap-[46px] xl:mt-[54px] xl:gap-[52px]">
            @foreach ($galleries as $gallery)
                <img src="{{ $gallery->photo_url }}" alt="{{ $gallery->title ?: 'Dokumentasi' }}" class="card-shadow aspect-[231/154] w-full rounded-[18px] object-cover">
            @endforeach
        </div>

        <div class="mt-8 flex justify-end lg:mt-[51px] xl:mt-[58px]">
            <a href="/galeri" class="inline-flex items-center gap-2 text-[17px] font-bold text-navy hover:underline xl:text-[19px]">
                Buka Seluruh Galeri <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>
</section>

{{-- 7. AJAKAN (CTA) --}}
<section class="px-5 py-12 sm:px-8 lg:py-[70px] xl:py-[80px]">
    <div class="mx-auto max-w-[1040px] rounded-[18px] bg-navy-deep px-6 py-12 text-center text-white sm:py-16 lg:py-[90px] xl:max-w-[1100px] xl:py-[110px]">
        <h2 class="mx-auto max-w-[820px] text-[26px] font-bold leading-[1.15] sm:text-[34px] lg:text-[40px] xl:text-[45px]">{{ $home->cta_title }}</h2>
        <p class="mx-auto mt-4 max-w-[621px] text-base leading-relaxed lg:text-lg xl:max-w-[680px]">{{ $home->cta_text }}</p>

        @if ($home->cta_button)
            <a href="/kontak" class="mt-8 inline-flex items-center gap-3 rounded-lg bg-white/15 px-7 py-3.5 text-lg font-semibold transition hover:bg-white/25 xl:mt-9 xl:px-8 xl:text-[21px]">
                {{ $home->cta_button }} <span aria-hidden="true">→</span>
            </a>
        @endif
    </div>
</section>

@endsection