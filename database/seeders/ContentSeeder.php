<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Teks singkat untuk kartu di beranda
        $excerpts = [
            'komputer'               => 'Penyediaan unit komputer enterprise, laptop dinas, workstation grafis, server rack, printer scanner presisi, storage data, dan suku cadang periferal.',
            'fotografi'              => 'Pengadaan sistem kamera profesional, lensa presisi, perlengkapan pencahayaan studio, dan instrumen optik.',
            'telekomunikasi'         => 'Penyediaan perangkat infrastruktur jaringan, router industri, switch komunikasi.',
            'suku-cadang-elektronik' => 'Distribusi komponen semikonduktor, papan sirkuit cetak, kabel konektor khusus.',
            'peralatan-dapur'        => 'Suplai perangkat kelistrikan, peralatan dapur komersial, mesin pendingin.',
        ];

        $images = [
            'komputer'               => 'layanan-komputer.jpg',
            'fotografi'              => 'layanan-fotografi.jpg',
            'telekomunikasi'         => 'layanan-telekomunikasi.jpg',
            'suku-cadang-elektronik' => 'layanan-suku-cadang.jpg',
            'peralatan-dapur'        => 'layanan-dapur.jpg',
        ];

        // 1. Layanan (diambil dari config/layanan.php)
        $urutan = 1;
        foreach (config('layanan') as $slug => $data) {
            Service::updateOrCreate(['slug' => $slug], [
                'title'          => $data['title'],
                'excerpt'        => $excerpts[$slug],
                'subtitle'       => $data['subtitle'],
                'summary'        => $data['ringkasan'],
                'standard_intro' => $data['standar_intro'],
                'points'         => $data['poin'],
                'photo'          => $this->salinGambar($images[$slug], 'services'),
                'sort_order'     => $urutan++,
                'is_active'      => true,
            ]);
        }

        // 2. Galeri
        foreach ([1, 2, 3, 4] as $n) {
            Gallery::updateOrCreate(['title' => "Dokumentasi $n"], [
                'photo'      => $this->salinGambar("galeri-$n.jpg", 'galleries'),
                'sort_order' => $n,
                'is_active'  => true,
            ]);
        }

        // 3. Pengaturan kontak
        SiteSetting::firstOrCreate([], [
            'company_name' => 'PT. Naba Technology Solutions',
            'address'      => 'Jl. Tukad Yeh Aya No. 46, Denpasar, Bali',
            'phone'        => '08113383803',
            'whatsapp'     => '628113383803',
            'email'        => 'ptnabatechnology@gmail.com',
            'hours'        => 'Senin - Sabtu: 08.00 - 17.00 WITA',
            'hours_note'   => 'Minggu & Hari Libur Nasional Tutup',
        ]);
    }

    // Menyalin gambar dari public/assets/img ke storage/app/public/<folder>
    private function salinGambar(string $file, string $folder): ?string
    {
        $sumber = public_path('assets/img/' . $file);

        if (! file_exists($sumber)) {
            return null;
        }

        $tujuan = $folder . '/' . $file;
        Storage::disk('public')->put($tujuan, file_get_contents($sumber));

        return $tujuan;
    }
}