<?php

namespace Database\Seeders;

use App\Models\ServicePage;
use Illuminate\Database\Seeder;

class ServicePageSeeder extends Seeder
{
    public function run(): void
    {
        ServicePage::firstOrCreate([], [
            'badge'      => 'Katalog Resmi KBLI',
            'title'      => 'Produk & Bidang Usaha Perdagangan Besar',
            'intro'      => 'Menghadirkan ekosistem perangkat teknologi dan peralatan rumah tangga terintegrasi untuk mendukung efisiensi serta kelancaran operasional perusahaan dan instansi Anda.',
            'list_title' => 'Daftar {jumlah} Sektor Pengadaan Komersial',
            'list_text'  => 'Pilih sektor di bawah ini untuk melihat rincian spesifikasi barang dan cakupan pengadaan.',
        ]);
    }
}