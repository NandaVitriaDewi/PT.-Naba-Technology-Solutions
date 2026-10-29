<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        AboutPage::firstOrCreate([], [
            'badge' => 'Profil Perusahaan',
            'title' => 'Mengenal PT. Naba Technology Solutions',
            'intro' => 'Perusahaan penyedia dan pengadaan B2B/B2G terpercaya yang berdiri pada tahun 2024 di Denpasar, Bali. Berkomitmen menjadi mitra pengadaan yang tangguh, profesional, dan berintegritas di 5 sektor utama.',

            'history_title' => 'Sejarah & Dedikasi',
            'history_paragraphs' => [
                ['text' => 'PT. Naba Technology Solutions didirikan dengan visi besar untuk menjawab tantangan dan kebutuhan pengadaan barang dan jasa yang transparan, efisien, serta bermutu tinggi di wilayah Bali dan seluruh Indonesia. Berawal dari semangat melayani sektor korporasi (B2B) dan pemerintah (B2G), kami tumbuh menjadi penyedia solusi terpadu yang berintegritas.'],
                ['text' => 'Dedikasi kami berlandaskan pada prinsip kepatuhan hukum, jaminan kualitas produk original bergaransi resmi, serta layanan purna jual yang tegas. Kami percaya bahwa setiap kemitraan adalah fondasi untuk membangun keberlanjutan bisnis mitra kami.'],
                ['text' => 'Dengan cakupan layanan lintas sektor, mulai dari sistem komputer, peralatan telekomunikasi, hingga infrastruktur, PT. Naba Technology Solutions terus berinovasi untuk memberikan nilai tambah terbaik bagi setiap proyek yang dipercayakan kepada kami.'],
            ],
            'history_image' => $this->salinGambar('tentang-foto.jpg'),

            'vision_title' => 'Visi Perusahaan',
            'vision_text'  => 'Menjadi perusahaan penyedia dan pengadaan komersial B2B & B2G terdepan, terpercaya, dan paling diandalkan di Indonesia melalui standar integritas tinggi, kepatuhan regulasi, serta inovasi rantai pasok terintegrasi.',
            'mission_title' => 'Misi Perusahaan',
            'mission_items' => [
                ['text' => 'Menyediakan perangkat teknologi, sarana operasional, dan suku cadang original bergaransi resmi.'],
                ['text' => 'Menerapkan kendali mutu ketat serta kepatuhan administrasi legalitas B2B dan B2G secara transparan.'],
                ['text' => 'Memberikan pendampingan teknis dan purna jual yang responsif demi kelancaran operasional mitra kami.'],
            ],

            'principles_title' => 'Prinsip Kerja & Integritas Kami',
            'principles_intro' => 'Nilai-nilai fundamental yang menjadi landasan operasional PT. Naba Technology Solutions dalam setiap transaksi dan kemitraan.',
            'principles' => [
                ['title' => 'Integritas & Kepatuhan Legal',   'text' => 'Setiap proses transaksi dilengkapi bukti legalitas, perizinan KBLI yang terverifikasi, dan kelengkapan administrasi penuh.'],
                ['title' => 'Jaminan Kualitas Original',      'text' => 'Seluruh barang diperoleh langsung dari distributor resmi tier-1 dengan garansi produk yang jelas dan terjamin.'],
                ['title' => 'Ketepatan Waktu & Distribusi',   'text' => 'Manajemen logistik yang terukur memastikan seluruh barang sampai di lokasi tujuan tepat waktu sesuai jadwal kerja Anda.'],
                ['title' => 'Kemitraan Berkelanjutan',        'text' => 'Kami hadir tidak hanya sebagai penyedia barang, tetapi sebagai mitra komunikatif yang siap mendampingi pengadaan Anda.'],
            ],

            'cta_title'    => 'Butuh Informasi Lebih Lengkap Mengenai Dokumen Legalitas?',
            'cta_text'     => 'Tim administrasi kami siap menyediakan profil badan usaha, dokumen perizinan KBLI, dan portofolio pasokan untuk verifikasi pengadaan Anda.',
            'cta_button_1' => 'Minta Profil & Dokumen',
            'cta_button_2' => 'Hubungi Tim Administrasi',
        ]);
    }

    // Menyalin gambar dari public/assets/img ke storage/app/public/about
    private function salinGambar(string $file): ?string
    {
        $sumber = public_path('assets/img/' . $file);

        if (! file_exists($sumber)) {
            return null;
        }

        $tujuan = 'about/' . $file;
        Storage::disk('public')->put($tujuan, file_get_contents($sumber));

        return $tujuan;
    }
}