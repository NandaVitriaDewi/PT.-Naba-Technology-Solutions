<?php

namespace Database\Seeders;

use App\Models\GalleryPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GalleryPageSeeder extends Seeder
{
    public function run(): void
    {
        // Foto dan keterangan diambil dari galeri.blade.php lo
        $daftar = [
            ['halaman-galeri-1.jpg', 'Perangkat Gaming & Workstation'],
            ['halaman-galeri-2.jpg', 'Pengujian & Pemrograman Laptop'],
            ['halaman-galeri-3.jpg', 'Pengadaan Peralatan Fotografi & Lensa'],
            ['halaman-galeri-4.jpg', 'Display Perangkat Dapur Komersial'],
            ['halaman-galeri-5.jpg', 'Komponen Suku Cadang Elektronik'],
            ['halaman-galeri-6.jpg', 'Inspeksi Kualitas Tablet & Handheld'],
            ['halaman-galeri-7.jpg', 'Stok Peralatan Masak & Elektronik'],
            ['halaman-galeri-8.jpg', 'Unit Laptop Dinas & Display Enterprise'],
        ];

        $photos = [];
        foreach ($daftar as [$file, $judul]) {
            $path = $this->salinGambar($file);

            if ($path) {
                $photos[] = ['image' => $path, 'title' => $judul];
            }
        }

        // Menimpa isi Halaman Galeri supaya sama dengan desain lo
        $page = GalleryPage::first() ?? new GalleryPage();

        $page->fill([
            'badge'  => 'Dokumentasi Visual',
            'title'  => 'Galeri Pengadaan & Aktivitas Operasional',
            'intro'  => 'Dokumentasi visual pasokan perangkat teknologi, fasilitas infrastruktur IT, dan kesiapan logistik PT Naba Technology Solutions.',
            'photos' => $photos,

            'cta_title'  => 'Kunjungan & Konsultasi Operasional',
            'cta_text'   => 'Kami terbuka untuk agenda audiensi, konsultasi kebutuhan perangkat teknologi, dan verifikasi kualifikasi penyedia di Jl. Tukad Yeh Aya No. 46, Denpasar, Bali.',
            'cta_button' => 'Lihat Rute ke Kantor',
            'cta_url'    => null,
        ])->save();
    }

    // Menyalin gambar dari public/assets/img ke storage/app/public/galeri
    private function salinGambar(string $file): ?string
    {
        $sumber = public_path('assets/img/' . $file);

        if (! file_exists($sumber)) {
            return null;
        }

        $tujuan = 'galeri/' . $file;
        Storage::disk('public')->put($tujuan, file_get_contents($sumber));

        return $tujuan;
    }
}