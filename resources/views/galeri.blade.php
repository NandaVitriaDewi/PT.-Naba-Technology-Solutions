@extends('layouts.frontend')

@section('title', 'Galeri & Dokumentasi | PT. Naba Technology Solutions')

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endpush

@php
    // Isi diambil dari menu "Halaman Galeri" di admin
    $fotos = $page->items();
    $alamat = \App\Models\SiteSetting::current()->address ?: 'Jl. Tukad Yeh Aya No. 46, Denpasar, Bali';
    $rute = $page->cta_url ?: 'https://www.google.com/maps/search/?api=1&query=' . urlencode($alamat);
@endphp

@section('content')

{{-- ================= BANNER HERO ATAS (WARNA BIRU NAVY) ================= --}}
<section class="bg-slate-900 text-white py-16 lg:py-20" style="background-color: #0B1528;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl" data-aos="fade-up" data-aos-duration="900">
            {{-- Badge Top --}}
            @if ($page->badge)
                <div class="mb-4">
                    <span class="inline-block rounded-full bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white-400 border border-white/10">
                        {{ $page->badge }}
                    </span>
                </div>
            @endif

            {{-- Judul Halaman --}}
            <h1 class="text-3xl font-extrabold tracking-tight sm:text-4xl lg:text-5xl leading-tight text-white">
                {{ $page->title }}
            </h1>

            {{-- Subtitle --}}
            @if ($page->intro)
                <p class="mt-4 text-sm sm:text-base text-slate-300 leading-relaxed max-w-2xl">
                    {{ $page->intro }}
                </p>
            @endif
        </div>
    </div>
</section>

{{-- ================= GRID GALERI ================= --}}
<section class="bg-white py-12 sm:py-16 lg:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Grid Galeri (1 Kolom HP, 2 Tablet, 4 Laptop) --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 lg:gap-7">
            @forelse ($fotos as $item)
                <div data-aos="fade-up" data-aos-delay="{{ 100 * $loop->iteration }}"
                     class="group relative overflow-hidden rounded-2xl bg-gray-100 shadow-md transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                    {{-- Container Foto --}}
                    <div class="aspect-[4/3] w-full overflow-hidden bg-gray-200">
                        <img src="{{ $item['url'] }}"
                             alt="{{ $item['title'] ?: 'Dokumentasi ' . $loop->iteration }}"
                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    {{-- Overlay Caption saat Hover --}}
                    @if ($item['title'])
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/30 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 flex items-end p-4">
                            <p class="text-xs font-semibold text-white leading-snug">
                                {{ $item['title'] }}
                            </p>
                        </div>
                    @endif
                </div>
            @empty
                <p class="col-span-full text-center text-gray-600">Belum ada foto yang ditampilkan.</p>
            @endforelse
        </div>

    </div>
</section>

{{-- ================= SECTION LOKASI KANTOR / CTA ================= --}}
<section class="bg-gray-100 py-14 lg:py-20">
    <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl" data-aos="zoom-in-up" data-aos-duration="800">
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl lg:text-4xl">
                {{ $page->cta_title }}
            </h2>

            @if ($page->cta_text)
                <p class="mx-auto mt-4 max-w-2xl text-sm text-gray-600 sm:text-base leading-relaxed">
                    {{ $page->cta_text }}
                </p>
            @endif

            {{-- Tombol Rute --}}
            @if ($page->cta_button)
                <a href="{{ $rute }}"
                   target="_blank"
                   class="mt-8 inline-flex items-center justify-center rounded-lg text-white shadow-md transition-all hover:shadow-lg sm:text-lg px-8 py-4 font-bold"
                   style="background-color: #0F172A;">
                    {{ $page->cta_button }}
                </a>
            @endif
        </div>
    </div>
</section>

{{-- CDN JS & INIT AOS --}}
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });
    });
</script>

@endsection