@extends('layouts.frontend')

@section('title', $layanan->title . ' | PT. Naba Technology Solutions')

@section('content')

{{-- 1. BANNER HEADER BIRU GELAP --}}
<section class="bg-[#0B1528] py-10 lg:py-14 text-white">
    <div class="wrap max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block rounded-full bg-white/10 border border-white/20 px-3.5 py-1 text-xs font-bold text-white tracking-wide uppercase">
            Katalog Resmi KBLI
        </span>
        <h1 class="mt-3 text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white leading-tight">
            {{ $layanan->title }}
        </h1>
        <p class="mt-2 text-xs sm:text-sm text-slate-300 leading-relaxed max-w-2xl">
            {{ $layanan->subtitle ?? 'Solusi pengadaan dan penyediaan komoditas berstandar industri untuk kebutuhan korporasi dan instansi Anda.' }}
        </p>
    </div>
</section>

{{-- 2. KONTEN UTAMA DETAIL LAYANAN --}}
<section class="py-10 lg:py-14 bg-white">
    <div class="wrap max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- KOLOM KIRI (FOTO, RINGKASAN, & LINK KEMBALI SIMPEL) --}}
            <div class="lg:col-span-5 space-y-4">
                {{-- Foto Utama --}}
                @if ($layanan->photo_url)
                    <img src="{{ $layanan->photo_url }}" alt="{{ $layanan->title }}"
                         class="aspect-square w-full rounded-[24px] object-cover shadow-sm border border-slate-100">
                @else
                    <div class="aspect-square w-full rounded-[24px] bg-slate-100 flex items-center justify-center text-slate-400">
                        Foto tidak tersedia
                    </div>
                @endif

                {{-- Box Ringkasan Layanan --}}
                <div class="rounded-[18px] bg-[#f8fafc] p-5 border border-slate-100">
                    <p class="text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-1.5">RINGKASAN LAYANAN</p>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $layanan->summary ?? $layanan->excerpt }}
                    </p>
                </div>

                {{-- Link Kembali Teks Simpel (Mepet Kiri) --}}
                <div class="pt-1">
                    <a href="{{ url('/layanan') }}" 
                       class="inline-flex items-center gap-2.5 text-xs sm:text-sm font-bold text-slate-900 hover:text-blue-900 transition-colors group">
                        <svg class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Kembali ke Seluruh Bidang Layanan</span>
                    </a>
                </div>
            </div>

            {{-- KOLOM KANAN (STANDAR KENDALI MUTU & CTA) --}}
            <div class="lg:col-span-7 space-y-6">
                
                {{-- Header Teks --}}
                <div>
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#0B1528] tracking-tight">
                        Standar Kendali Mutu &amp; Jaminan
                    </h2>
                    <p class="mt-1.5 text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Dalam setiap kontrak pengadaan Komputer dan Infrastruktur IT, PT Naba Technology Solutions menerapkan standar kendali mutu ketat yang meliputi:
                    </p>
                </div>

                {{-- List Poin (Kartu Ramping) --}}
                <div class="space-y-2.5">
                    @foreach ($layanan->points ?? [] as $index => $poin)
                        <div class="flex items-center gap-3.5 rounded-[16px] bg-white p-3.5 sm:p-4 border border-slate-100 shadow-sm transition hover:shadow-md">
                            {{-- Badge Angka --}}
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#0B1528] text-xs font-bold text-white shadow-sm">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </div>
                            {{-- Isi Poin --}}
                            <div>
                                <h3 class="text-xs sm:text-sm font-bold text-[#0B1528] leading-snug">
                                    {{ $poin['judul'] ?? 'Judul Poin' }}
                                </h3>
                                <p class="mt-0.5 text-[11px] sm:text-xs text-slate-500 leading-relaxed">
                                    {{ $poin['isi'] ?? 'Keterangan detail poin kendali mutu.' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- CTA Box --}}
                <div class="rounded-[20px] bg-[#0B1528] p-6 text-white shadow-lg space-y-3">
                    <h3 class="text-base sm:text-lg font-bold text-white">
                        Butuh Penawaran Pengadaan?
                    </h3>
                    <p class="text-xs text-slate-300 leading-relaxed max-w-xl">
                        Tim teknis dan legalitas PT Naba Technology Solutions siap membantu pemenuhan kualifikasi tender dan spesifikasi instansi Anda.
                    </p>
                    <div class="pt-1">
                        <a href="/kontak" 
                           class="inline-block rounded-xl bg-[#e11d48] px-5 py-2.5 text-xs font-bold text-white transition hover:bg-[#be123c] uppercase tracking-wider shadow-md">
                            HUBUNGI TIM MARKETING
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

@endsection