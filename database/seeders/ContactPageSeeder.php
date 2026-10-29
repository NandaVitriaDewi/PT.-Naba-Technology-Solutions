<?php

namespace Database\Seeders;

use App\Models\ContactPage;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        ContactPage::firstOrCreate([], [
            'badge' => 'Pusat Komunikasi Resmi',
            'title' => 'Hubungi PT. Naba Technology Solutions',
            'intro' => 'Sampaikan kebutuhan pengadaan barang, penawaran tender, atau konsultasi komersial kepada tim kami. Kami siap memberikan penawaran terbaik.',

            'info_title'    => 'Informasi Kontak & Jam Kerja',
            'info_text'     => 'Silakan menghubungi kami melalui saluran resmi atau kunjungi kantor operasional kami di Denpasar, Bali.',
            'map_embed_url' => null,

            'form_label'   => 'Formulir Penawaran & Pertanyaan',
            'form_title'   => 'Kirimkan Pesan atau Permintaan Harga',
            'form_intro'   => 'Lengkapilah rincian di bawah ini. Tim representatif kami akan meninjau dan merespon kembali secara tertulis.',
            'form_button'  => 'Kirim Permintaan Penawaran',
            'form_note'    => 'Data yang Anda sampaikan dilindungi kerahasiaannya dan hanya digunakan untuk keperluan kalkulasi penawaran.',
            'form_success' => 'Terima kasih, pesan Anda sudah kami terima. Tim kami akan segera menghubungi Anda.',
        ]);
    }
}