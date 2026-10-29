<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        HomeContent::firstOrCreate([], [
            'hero_badge'  => 'Penyedia Resmi & Terverifikasi · Est. 2024',
            'hero_title'  => 'Mitra Terpercaya Perdagangan Skala Besar',
            'hero_text'   => 'Penyedia resmi perlengkapan komputer, telekomunikasi, fotografi, barang optik, serta peralatan masak, dan elektronik rumah tangga di Denpasar, Bali',
            'hero_button' => 'Jelajahi Layanan',
            'hero_image'  => $this->salinGambar('hero.jpg'),

            'stats' => [
                ['value' => '2024',     'label' => 'Tahun Berdiri'],
                ['value' => '5 Sektor', 'label' => 'Klasifikasi KBLI Terverifikasi'],
                ['value' => 'Bali',     'label' => 'Jangkauan Distribusi'],
            ],

            'about_title'  => 'Mitra Pengadaan IT & Elektronik Terpercaya',
            'about_text'   => 'Berdiri sejak tahun 2024 dan berpusat di Denpasar, Bali, PT Naba Technology Solutions bergerak di 5 sektor pengadaan utama. Kami berkomitmen menyediakan produk berkualitas tinggi dan layanan purna jual terbaik untuk mendukung pertumbuhan bisnis serta operasional instansi Anda.',
            'about_button' => 'Minta Penawaran',
            'about_image'  => $this->salinGambar('tentang-mitra.jpg'),

            'catalog_title'  => 'Katalog Produk',
            'catalog_text'   => 'Menyediakan ragam perangkat teknologi, infrastruktur telekomunikasi, dan peralatan multisektor berstandar industri dengan jaminan kualitas terbaik untuk kebutuhan bisnis dan instansi Anda.',
            'catalog_button' => 'Lihat Seluruh Katalog Bidang Usaha',

            'process_title' => 'Alur Pengadaan IT & Elektronik Profesional',
            'process_intro' => 'Kami menghadirkan proses pengadaan B2B yang transparan, efisien, dan tersistematis untuk memastikan pemenuhan infrastruktur teknologi instansi Anda berjalan lancar sesuai spesifikasi.',
            'process_steps' => [
                ['title' => 'Konsultasi & Analisis Kebutuhan',  'text' => 'Diskusi mendalam terkait spesifikasi teknis perangkat yang paling efisien untuk skala proyek Anda.'],
                ['title' => 'Penawaran Transparan',             'text' => 'Penyusunan penawaran harga secara detail, dilengkapi dokumen legalitas pengadaan perusahaan.'],
                ['title' => 'Quality Control & Inspeksi Ketat', 'text' => 'Pemeriksaan fisik dan sistem secara menyeluruh untuk menjamin keaslian unit, dan kelayakan operasional.'],
                ['title' => 'Distribusi & Dukungan Purna Jual', 'text' => 'Pengiriman aman dan tepat waktu ke lokasi tujuan, kelengkapan faktur, serta komitmen bantuan klaim garansi resmi.'],
            ],
            'process_image_1' => $this->salinGambar('alur-1.jpg'),
            'process_image_2' => $this->salinGambar('alur-2.jpg'),

            'gallery_title'   => 'Dokumentasi Produk & Pengadaan',
            'gallery_caption' => 'Potret operasional penyediaan komoditas.',

            'cta_title'  => 'Siap Memulai Kerjasama Pengadaan Bersama Kami?',
            'cta_text'   => 'Hubungi tim representatif PT. Naba Technology Solutions sekarang untuk mendapatkan konsultasi teknis dan penawaran harga terbaik.',
            'cta_button' => 'Hubungi Tim Kami',
        ]);
    }

    // Menyalin gambar dari public/assets/img ke storage/app/public/home
    private function salinGambar(string $file): ?string
    {
        $sumber = public_path('assets/img/' . $file);

        if (! file_exists($sumber)) {
            return null;
        }

        $tujuan = 'home/' . $file;
        Storage::disk('public')->put($tujuan, file_get_contents($sumber));

        return $tujuan;
    }
}