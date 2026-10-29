@extends('layouts.frontend')

@section('title', 'Produk & Bidang Usaha | PT. Naba Technology Solutions')

@section('content')

{{-- 1. BANNER HEADER --}}
<section class="bg-footer text-white">
    <div class="wrap py-12 lg:pb-[50px] lg:pt-[64px] 2xl:pb-[60px] 2xl:pt-[80px]">
        <span class="inline-block rounded-[10px] bg-white/10 border border-white/20 px-3 py-1.5 text-xs font-bold text-white tracking-wide 2xl:px-4 2xl:text-[15px]">Katalog Resmi KBLI</span>
        <h1 class="mt-5 max-w-[800px] text-[32px] font-bold leading-[1.2] sm:text-[40px] lg:text-[46px] 2xl:max-w-[950px] 2xl:text-[56px]">Produk &amp; Bidang Usaha Perdagangan Besar</h1>
        <p class="mt-4 max-w-[680px] text-xs leading-relaxed text-gray-300 sm:text-sm lg:text-[15px] 2xl:max-w-[860px] 2xl:text-[18px]">
            Menghadirkan ekosistem perangkat teknologi dan peralatan rumah tangga terintegrasi untuk mendukung efisiensi serta kelancaran operasional perusahaan dan instansi Anda.
        </p>
    </div>
</section>

{{-- 2. DAFTAR SEKTOR PENGADAAN (GRID CARD) --}}
<section class="py-12 lg:py-[75px] 2xl:py-[95px]">
    <div class="wrap">
        
        <div class="mb-10">
            <h2 class="text-xl font-bold text-navy sm:text-2xl lg:text-[26px]">Daftar Sektor Pengadaan Komersial</h2>
            <p class="mt-1 text-xs text-gray-600 sm:text-sm">Pilih sektor di bawah ini untuk melihat rincian spesifikasi barang dan cakupan pengadaan.</p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-[30px]">
            @foreach ($services as $service)
                <div class="flex flex-col justify-between rounded-[24px] bg-white p-6 shadow-card border border-line/60 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 2xl:p-8">
                    <div>
                        @if ($service->photo_url)
                            <img src="{{ $service->photo_url }}" alt="{{ $service->title }}" class="aspect-[16/10] w-full rounded-[16px] object-cover mb-5">
                        @endif
                        <h3 class="text-base font-bold text-navy lg:text-lg 2xl:text-[20px] leading-snug">{{ $service->title }}</h3>
                        <p class="mt-2 text-xs leading-relaxed text-gray-600 sm:text-[13px] 2xl:text-[15px]">{{ $service->summary }}</p>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-line/40">
                        <a href="/layanan/{{ $service->slug }}" class="inline-flex items-center gap-2 text-xs font-bold text-navy hover:underline lg:text-sm">
                            Rincian &amp; Spesifikasi <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection