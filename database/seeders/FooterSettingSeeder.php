<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    public function run(): void
    {
        FooterSetting::firstOrCreate([], [
            'tagline'     => 'Mitra Pengadaan Terpercaya Sejak 2024',
            'description' => 'Perusahaan penyedia dan perdagangan besar terpercaya yang berkomitmen menghadirkan pasokan perangkat keras berstandar tinggi untuk kebutuhan instansi pemerintah, BUMN, maupun swasta.',
            'badges' => [
                ['text' => 'EST. 2024',       'style' => 'gelap'],
                ['text' => 'DENPASAR • BALI', 'style' => 'gelap'],
                ['text' => '5 BIDANG KBLI',   'style' => 'terang'],
            ],

            'services_title' => 'BIDANG LAYANAN',

            'nav_title' => 'NAVIGASI',
            'nav_links' => [
                ['label' => 'Beranda',            'url' => '/'],
                ['label' => 'Profil Perusahaan',  'url' => '/tentang-kami'],
                ['label' => 'Katalog & Produk',   'url' => '/layanan'],
                ['label' => 'Galeri Dokumentasi', 'url' => '/galeri'],
                ['label' => 'Hubungi Kami',       'url' => '/kontak'],
            ],

            'office_title' => 'KANTOR PUSAT',

            'copyright' => 'PT. Naba Technology Solutions. Hak cipta dilindungi undang-undang.',
        ]);
    }
}