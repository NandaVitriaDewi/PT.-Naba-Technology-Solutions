@extends('layouts.frontend')

@section('title', 'Tentang Kami | PT. Naba Technology Solutions')

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endpush

@section('content')

{{-- ================= 1. HERO SECTION (MENGENAL PT. NABA) ================= --}}
<section class="relative bg-cover bg-center py-16 lg:py-24 text-white" 
         style="background-image: url('{{ asset('assets/img/about-building.jpg') }}');">
    
    {{-- Overlay Gelap Supaya Teks Tetap Jelas/Kelihatan --}}
    <div class="absolute inset-0 bg-[#0B1528]/80"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-3xl space-y-4">
            
            {{-- Badge Top (Penyedia Resmi & Terverifikasi - Transparent Glassmorphism) --}}
            <div>
                <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-wide text-white sm:text-xs backdrop-blur-sm transition-colors duration-300 hover:bg-white/20 cursor-pointer">
                    Profile Perusahaan
                </span>
            </div>

            {{-- Judul Halaman --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                Mengenal PT. Naba<br class="hidden sm:inline" /> Technology Solutions
            </h1>

            {{-- Deskripsi --}}
            <p class="text-sm sm:text-base lg:text-lg text-slate-200 leading-relaxed">
                Perusahaan penyedia dan pengadaan B2B/B2G terpercaya yang berdiri pada tahun 2024 di Denpasar, Bali. Berkomitmen menjadi mitra pengadaan yang tangguh, profesional, dan berintegritas di 5 sektor utama.
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
                    Sejarah &amp; Dedikasi
                </h2>
                
                <div class="space-y-4 text-xs sm:text-sm lg:text-base text-slate-600 leading-relaxed text-justify">
                    <p>
                        PT. Naba Technology Solutions didirikan dengan visi besar untuk menjawab tantangan dan kebutuhan pengadaan barang dan jasa yang transparan, efisien, serta berkualitas tinggi di wilayah Bali dan seluruh Indonesia. Berawal dari semangat melayani sektor korporasi (B2B) dan pemerintah (B2G), kami tumbuh menjadi penyedia solusi terpadu yang berintegritas.
                    </p>
                    <p>
                        Dedikasi kami berlandaskan pada prinsip kepatuhan hukum, jaminan kualitas produk orisinal bergaransi resmi, serta layanan purna jual yang sigap. Kami percaya bahwa setiap kemitraan adalah fondasi untuk membangun keberlanjutan bisnis mitra kami.
                    </p>
                    <p>
                        Dengan cakupan layanan lintas sektor, mulai dari teknologi informasi, peralatan kantor, hingga infrastruktur. PT. Naba Technology Solutions terus berinovasi untuk memberikan nilai tambah terbaik bagi setiap proyek yang dipercayakan kepada kami.
                    </p>
                </div>
            </div>

            {{-- Kolom Kanan: Foto Tim / Rapat --}}
            <div class="lg:col-span-5" data-aos="fade-left" data-aos-duration="900" data-aos-delay="200">
                <div class="relative overflow-hidden rounded-3xl shadow-sm border border-slate-100 bg-slate-100">
                    <img src="{{ asset('assets/img/about-team.jpg') }}" 
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
                    Visi Perusahaan
                </h3>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                    Menjadi perusahaan penyedia dan pengadaan komersial B2B &amp; B2G terdepan, terpercaya, dan paling diandalkan di Indonesia melalui standar integritas tinggi, kepatuhan regulasi, serta inovasi rantai pasok terintegrasi.
                </p>
            </div>

            {{-- Card Misi Perusahaan --}}
            <div data-aos="fade-up" data-aos-delay="200" class="rounded-3xl bg-white p-8 sm:p-10 shadow-sm border border-slate-200/50 flex flex-col justify-start transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-4">
                    Misi Perusahaan
                </h3>
                <ul class="space-y-3 text-sm sm:text-base text-slate-600 leading-relaxed list-disc list-inside">
                    <li>Menyediakan perangkat teknologi, sarana operasional, dan suku cadang orisinal bergaransi resmi.</li>
                    <li>Menerapkan kendali mutu ketat serta kepatuhan administrasi legalitas B2B dan B2G secara transparan.</li>
                    <li>Memberikan pendampingan teknis dan purna jual yang responsif demi kepuasan serta keberlanjutan operasional mitra.</li>
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ================= 4. SECTION PRINSIP KERJA & INTEGRITAS KAMI ================= --}}
<section class="bg-white py-14 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Judul & Subtitle --}}
        <div class="max-w-3xl mb-10" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                Prinsip Kerja &amp; Integritas Kami
            </h2>
            <p class="mt-2 text-sm sm:text-base text-slate-600 leading-relaxed">
                Nilai-nilai fundamental yang menjadi landasan operasional PT. Naba Technology Solutions dalam setiap transaksi dan kemitraan.
            </p>
        </div>

        {{-- 2x2 Grid Prinsip Kerja --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            
            {{-- Card 1 --}}
            <div data-aos="zoom-in-up" data-aos-delay="100" class="rounded-3xl bg-slate-100/80 p-7 sm:p-8 flex flex-col gap-2 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <h3 class="text-lg sm:text-xl font-bold text-slate-900">1. Integritas &amp; Kepatuhan Legal</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Setiap proses transaksi dilengkapi dengan faktur pajak resmi, dokumen legalitas perizinan KBLI terverifikasi, dan transparansi administrasi penuh.
                </p>
            </div>

            {{-- Card 2 --}}
            <div data-aos="zoom-in-up" data-aos-delay="200" class="rounded-3xl bg-slate-100/80 p-7 sm:p-8 flex flex-col gap-2 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <h3 class="text-lg sm:text-xl font-bold text-slate-900">2. Jaminan Kualitas Orisinal</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Seluruh komoditas barang dipasok dari distributor resmi tier-1 dengan jaminan purna jual dan garansi produk terjamin.
                </p>
            </div>

            {{-- Card 3 --}}
            <div data-aos="zoom-in-up" data-aos-delay="300" class="rounded-3xl bg-slate-100/80 p-7 sm:p-8 flex flex-col gap-2 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <h3 class="text-lg sm:text-xl font-bold text-slate-900">3. Ketepatan Waktu &amp; Distribusi</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Pengemasan protektif dan manajemen logistik yang sigap memastikan seluruh barang sampai sesuai tenggat waktu Kerangka Acuan Kerja.
                </p>
            </div>

            {{-- Card 4 --}}
            <div data-aos="zoom-in-up" data-aos-delay="400" class="rounded-3xl bg-slate-100/80 p-7 sm:p-8 flex flex-col gap-2 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <h3 class="text-lg sm:text-xl font-bold text-slate-900">4. Kemitraan Berkelanjutan</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Kami hadir tidak hanya sebagai penyedia barang, tetapi sebagai mitra konsultatif yang siap mendampingi kebutuhan teknis instansi Anda.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- ================= 5. SECTION CTA DOKUMEN LEGALITAS ================= --}}
<section class="bg-white py-14 lg:py-20 border-t border-slate-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4" data-aos="zoom-in-up" data-aos-duration="800">
        
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
            Butuh Informasi Lebih Lengkap Mengenai Dokumen Legalitas?
        </h2>
        
        <p class="text-xs sm:text-sm sm:text-base text-slate-600 leading-relaxed max-w-2xl mx-auto">
            Tim administrasi kami siap menyediakan profil badan usaha, dokumen perizinan KBLI, dan portofolio pasokan untuk verifikasi pengadaan Anda.
        </p>

        {{-- 2 Tombol: Minta Profil (Navy) & WhatsApp (Hijau WhatsApp) --}}
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ url('/kontak') }}" 
               class="w-full sm:w-auto rounded-xl bg-[#0B1528] px-8 py-3.5 text-xs sm:text-sm font-bold text-white shadow-sm transition-all duration-300 hover:scale-105 hover:bg-slate-800">
                Minta Profil &amp; Dokumen
            </a>
            
            <a href="https://wa.me/628113383803" target="_blank" 
               class="w-full sm:w-auto rounded-xl px-8 py-3.5 text-xs sm:text-sm font-bold text-white shadow-sm transition-all duration-300 hover:scale-105 hover:opacity-90"
               style="background-color: #25D366;">
                Hubungi Tim Administrasi
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