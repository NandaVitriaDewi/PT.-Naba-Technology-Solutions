@extends('layouts.frontend')

@section('title', 'Tentang Kami | PT. Naba Technology Solutions')

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endpush

@section('content')

{{-- ================= 1. HERO SECTION ================= --}}
<section class="relative bg-cover bg-center py-16 lg:py-24 text-white"
         style="background-image: url('{{ $page->imageUrl('hero_image', 'about-building.jpg') }}');">
    <div class="absolute inset-0 bg-[#0B1528]/80"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-3xl space-y-4">
            <div>
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide text-white sm:text-xs backdrop-blur-sm transition-colors duration-300 hover:bg-white/20 cursor-pointer">
                    {{ $page->badge ?: 'Profile Perusahaan' }}
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                {{ $page->title ?: 'Mengenal PT. Naba Technology Solutions' }}
            </h1>

            <p class="text-sm sm:text-base lg:text-lg text-slate-200 leading-relaxed">
                {{ $page->intro }}
            </p>
        </div>
    </div>
</section>

{{-- ================= 2. SECTION SEJARAH & DEDIKASI ================= --}}
<section class="bg-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            {{-- Kolom Kiri: Deskripsi Sejarah & Dedikasi --}}
            <div class="lg:col-span-7 space-y-4" data-aos="fade-right" data-aos-duration="900">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ $page->history_title ?: 'Sejarah & Dedikasi' }}
                </h2>

                <div class="space-y-4 text-xs sm:text-sm lg:text-base text-slate-600 leading-relaxed text-justify">
                    @if(!empty($page->history_paragraphs))
                        @foreach($page->history_paragraphs as $p)
                            <p>{{ $p['text'] }}</p>
                        @endforeach
                    @else
                        <p>Belum ada teks sejarah.</p>
                    @endif
                </div>
            </div>

            {{-- Kolom Kanan: Foto Tim / Rapat --}}
            <div class="lg:col-span-5" data-aos="fade-left" data-aos-duration="900" data-aos-delay="200">
                <div class="relative overflow-hidden rounded-3xl shadow-sm border border-slate-100 bg-slate-100">
                    <img src="{{ $page->imageUrl('history_image', 'about-team.jpg') }}"
                         alt="Tim PT Naba Technology Solutions"
                         class="w-full h-[260px] sm:h-[340px] lg:h-[380px] object-cover object-center transition-transform duration-500 hover:scale-[1.02]">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= 3. SECTION VISI & MISI PERUSAHAAN ================= --}}
<section class="bg-slate-100/80 py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
            {{-- Card Visi Perusahaan --}}
            <div data-aos="fade-up" data-aos-delay="100" class="rounded-3xl bg-white p-8 sm:p-10 shadow-sm border border-slate-200/50 flex flex-col justify-start transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-4">
                    {{ $page->vision_title ?: 'Visi Perusahaan' }}
                </h3>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    {{ $page->vision_text }}
                </p>
            </div>

            {{-- Card Misi Perusahaan --}}
            <div data-aos="fade-up" data-aos-delay="200" class="rounded-3xl bg-white p-8 sm:p-10 shadow-sm border border-slate-200/50 flex flex-col justify-start transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-4">
                    {{ $page->mission_title ?: 'Misi Perusahaan' }}
                </h3>
                <ul class="space-y-3 text-sm sm:text-base text-slate-600 leading-relaxed list-disc list-inside">
                    @if(!empty($page->mission_items))
                        @foreach($page->mission_items as $item)
                            <li>{{ $item['text'] }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ================= 4. SECTION PRINSIP KERJA ================= --}}
<section class="bg-white py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-10" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                {{ $page->principles_title ?: 'Prinsip Kerja & Integritas Kami' }}
            </h2>
            <p class="mt-2 text-sm sm:text-base text-slate-600 leading-relaxed">
                {{ $page->principles_intro }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @if(!empty($page->principles))
                @foreach($page->principles as $index => $principle)
                    <div data-aos="zoom-in-up" data-aos-delay="{{ ($index + 1) * 100 }}" class="rounded-3xl bg-slate-100/80 p-7 sm:p-8 flex flex-col gap-2 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                        <h3 class="text-lg sm:text-xl font-bold text-slate-900">{{ $principle['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            {{ $principle['text'] }}
                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ================= 5. SECTION CTA DOKUMEN LEGALITAS ================= --}}
<section class="bg-white py-14 lg:py-20 border-t border-slate-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4" data-aos="zoom-in-up" data-aos-duration="800">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
            {{ $page->cta_title ?: 'Butuh Informasi Lebih Lengkap Mengenai Dokumen Legalitas?' }}
        </h2>
        <p class="text-xs sm:text-sm sm:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
            {{ $page->cta_text }}
        </p>

        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ url('/kontak') }}"
               class="w-full sm:w-auto rounded-xl bg-[#0B1528] px-8 py-3.5 text-xs sm:text-sm font-bold text-white shadow-sm transition-all duration-300 hover:scale-105 hover:bg-slate-800">
                {{ $page->cta_button_1 ?: 'Minta Profil & Dokumen' }}
            </a>
            <a href="https://wa.me/628113383803" target="_blank"
               class="w-full sm:w-auto rounded-xl px-8 py-3.5 text-xs sm:text-sm font-bold text-white shadow-sm transition-all duration-300 hover:scale-105 hover:opacity-90"
               style="background-color: #25D366;">
                {{ $page->cta_button_2 ?: 'Hubungi Tim Administrasi' }}
            </a>
        </div>
    </div>
</section>

{{-- CDN JS & INISIALISASI AOS --}}
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