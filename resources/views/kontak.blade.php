@extends('layouts.frontend')

@section('title', 'Hubungi Kami | PT. Naba Technology Solutions')

{{-- Data dari admin (menu Halaman Kontak) --}}
@php
    $wa       = $setting->whatsapp ?: '628113383803';
    $mapsLink = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($setting->address ?: 'Denpasar, Bali');
    $mapSrc   = $page->map_embed_url ?: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.135430852033!2d115.2281!3d-8.6784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwNDAnNDIuMiJTIDExNcKwMTMnNDEuMiJF!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid';
@endphp

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endpush

@section('content')

{{-- ================= BANNER HERO ATAS ================= --}}
<section class="bg-[#0B1528] py-16 lg:py-20 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl" data-aos="fade-up" data-aos-duration="900">
            {{-- Badge Top --}}
            @if ($page->badge)
                <div class="mb-4">
                    <span class="inline-block rounded-full bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white-400 border border-white/10">
                        {{ $page->badge }}
                    </span>
                </div>
            @endif

            {{-- Judul --}}
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

{{-- ================= KONTEN UTAMA KONTAK ================= --}}
<section class="bg-white py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Grid Utama (5 Kolom Kiri, 7 Kolom Kanan) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

            {{-- ================= KOLOM KIRI: INFO KONTAK & MAPS ================= --}}
            <div class="lg:col-span-5 flex flex-col gap-6" data-aos="fade-right" data-aos-duration="900">
                <div>
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 tracking-tight">
                        {{ $page->info_title }}
                    </h2>
                    @if ($page->info_text)
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            {{ $page->info_text }}
                        </p>
                    @endif
                </div>

                {{-- Container Card Kontak --}}
                <div class="flex flex-col gap-4">

                    {{-- 1. Card Alamat --}}
                    <div data-aos="fade-up" data-aos-delay="100" class="flex items-center gap-4 rounded-2xl bg-[#E8F1FF] p-4 sm:p-5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center text-slate-900">
                            <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">ALAMAT KANTOR</span>
                            <p class="mt-0.5 text-xs sm:text-sm font-bold text-slate-900">
                                {{ $setting->address }}
                            </p>
                        </div>
                    </div>

                    {{-- 2. Card Telepon & WhatsApp --}}
                    <div data-aos="fade-up" data-aos-delay="200" class="flex items-center justify-between gap-4 rounded-2xl bg-[#E8F1FF] p-4 sm:p-5">
                        <div class="flex items-center gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center text-slate-900">
                                <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.826-1.47-5.114-3.758-6.584-6.584l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">TELEPON & WHATSAPP</span>
                                <p class="mt-0.5 text-xs sm:text-sm font-bold text-slate-900">{{ $setting->phone }}</p>
                            </div>
                        </div>
                        <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="rounded-xl bg-[#22C55E] px-4 py-2 text-xs font-bold text-white transition-all hover:bg-emerald-600 shadow-sm">
                            CHAT
                        </a>
                    </div>

                    {{-- 3. Card Email --}}
                    <div data-aos="fade-up" data-aos-delay="300" class="flex items-center gap-4 rounded-2xl bg-[#E8F1FF] p-4 sm:p-5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center text-slate-900">
                            <svg class="size-6 fill-current" viewBox="0 0 24 24">
                                <path d="M1.5 4.5a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 4.5v15a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 19.5v-15ZM3 6.606v12.894c0 .414.336.75.75.75h16.5a.75.75 0 0 0 .75-.75V6.606l-8.54 5.337a1.5 1.5 0 0 1-1.62 0L3 6.606ZM19.98 4.5H4.02L12 9.488 19.98 4.5Z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">EMAIL</span>
                            <p class="mt-0.5 text-xs sm:text-sm font-bold text-slate-900">
                                {{ $setting->email }}
                            </p>
                        </div>
                    </div>

                    {{-- 4. Card Jam Pelayanan --}}
                    <div data-aos="fade-up" data-aos-delay="400" class="flex items-center gap-4 rounded-2xl bg-[#E8F1FF] p-4 sm:p-5">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center text-slate-900">
                            <svg class="size-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">JAM PELAYANAN</span>
                            <p class="mt-0.5 text-xs sm:text-sm font-bold text-slate-900">
                                {{ $setting->hours }}
                            </p>
                            @if ($setting->hours_note)
                                <p class="text-[11px] text-slate-500">{{ $setting->hours_note }}</p>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Embed Maps --}}
                <div data-aos="fade-up" data-aos-delay="500" class="relative mt-2 overflow-hidden rounded-3xl border border-slate-200/80 shadow-sm">
                    <a href="{{ $mapsLink }}" target="_blank" rel="noopener"
                       class="absolute top-4 left-4 z-10 rounded-lg bg-white px-3.5 py-1.5 text-xs font-bold text-[#0070F3] shadow-md hover:bg-slate-50">
                        Buka di Maps
                    </a>
                    <iframe
                        src="{{ $mapSrc }}"
                        class="h-64 w-full border-0"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            {{-- ================= KOLOM KANAN: FORMULIR PENAWARAN (STICKY) ================= --}}
            <div class="lg:col-span-7 lg:sticky lg:top-24" data-aos="fade-left" data-aos-duration="900" data-aos-delay="200">
                <div id="formulir" class="rounded-3xl bg-[#F0F2F5] p-6 sm:p-8 lg:p-9 border border-slate-200/40">
                    @if ($page->form_label)
                        <span class="block text-[10px] font-extrabold uppercase tracking-wider text-[#0B1528]">
                            {{ $page->form_label }}
                        </span>
                    @endif
                    <h3 class="mt-1 text-2xl font-extrabold tracking-tight text-[#0B1528] sm:text-3xl">
                        {{ $page->form_title }}
                    </h3>
                    @if ($page->form_intro)
                        <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed">
                            {{ $page->form_intro }}
                        </p>
                    @endif

                    {{-- Pesan berhasil (muncul setelah form terkirim) --}}
                    @if (session('sukses'))
                        <div class="mt-5 rounded-xl bg-green-100 px-4 py-3 text-xs sm:text-sm text-green-800">
                            {{ session('sukses') }}
                        </div>
                    @endif

                    {{-- Pesan error (muncul kalau isian belum benar) --}}
                    @if ($errors->any())
                        <div class="mt-5 rounded-xl bg-red-100 px-4 py-3 text-xs sm:text-sm text-red-800">
                            <p class="font-bold">Mohon periksa kembali isian Anda:</p>
                            <ul class="mt-1 list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/kontak" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            {{-- Nama Lengkap --}}
                            <div>
                                <label for="nama" class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-800 mb-1.5">
                                    NAMA LENGKAP/INSTANSI
                                </label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Nanda Vitria/ RSUD Batur"
                                    class="w-full rounded-xl border-0 bg-white px-3.5 py-2.5 text-xs text-slate-800 placeholder-slate-400 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-800 mb-1.5">
                                    ALAMAT EMAIL
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@instansi.com"
                                    class="w-full rounded-xl border-0 bg-white px-3.5 py-2.5 text-xs text-slate-800 placeholder-slate-400 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            {{-- Nomor Telepon --}}
                            <div>
                                <label for="telepon" class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-800 mb-1.5">
                                    NOMOR TELEPON/WHATSAPP
                                </label>
                                <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx"
                                    class="w-full rounded-xl border-0 bg-white px-3.5 py-2.5 text-xs text-slate-800 placeholder-slate-400 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>

                            {{-- Sektor Kebutuhan --}}
                            <div>
                                <label for="subjek" class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-800 mb-1.5">
                                    SEKTOR / SUBJEK KEBUTUHAN
                                </label>
                                <input type="text" id="subjek" name="subjek" value="{{ old('subjek') }}" placeholder="Contoh: Pengadaan alat Lab"
                                    class="w-full rounded-xl border-0 bg-white px-3.5 py-2.5 text-xs text-slate-800 placeholder-slate-400 shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>
                        </div>

                        {{-- Rincian Kebutuhan --}}
                        <div>
                            <label for="pesan" class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-800 mb-1.5">
                                RINCIAN KEBUTUHAN & SPESIFIKASI
                            </label>
                            <textarea id="pesan" name="pesan" rows="4" required placeholder="Jelaskan spesifikasi komoditas, estimasi kuantitas volume, lokasi tujuan serah terima, dan tenggat waktu pelaksanaan..."
                                class="w-full rounded-xl border-2 border-[#0070F3] bg-white px-3.5 py-2.5 text-xs text-slate-800 placeholder-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('pesan') }}</textarea>
                        </div>

                        {{-- Tombol Submit --}}
                        <button type="submit"
                            class="w-full rounded-xl bg-[#0B1528] py-3.5 text-center text-xs font-bold text-white shadow-sm transition-all hover:bg-slate-800">
                            {{ $page->form_button ?: 'Kirim' }}
                        </button>

                        {{-- Disclaimer --}}
                        @if ($page->form_note)
                            <p class="mt-2 text-center text-[10px] text-slate-400">
                                {{ $page->form_note }}
                            </p>
                        @endif
                    </form>
                </div>
            </div>

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

        // Setelah form dikirim (berhasil atau ada error), gulir ke kotak formulir
        @if (session('sukses') || $errors->any())
            document.getElementById('formulir')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        @endif
    });
</script>

@endsection