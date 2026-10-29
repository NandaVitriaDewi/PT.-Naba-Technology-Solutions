<?php

use App\Models\AboutPage;
use App\Models\ContactPage;
use App\Models\Gallery;
use App\Models\GalleryPage;
use App\Models\HomeContent;
use App\Models\Message;
use App\Models\Service;
use App\Models\ServicePage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. Beranda  -> resources/views/beranda.blade.php
Route::get('/', function () {
    return view('beranda', [
        'home'      => HomeContent::current(),
        'services'  => Service::active()->get(),
        'galleries' => Gallery::active()->take(4)->get(),
    ]);
});

// 2. Tentang Kami  -> resources/views/frontend/layanan/tentang.blade.php
Route::get('/tentang-kami', function () {
    return view('frontend.layanan.tentang', [
        'page' => AboutPage::current(),
    ]);
});

// 3. Daftar layanan  -> resources/views/layanan.blade.php
Route::get('/layanan', function () {
    return view('layanan', [
        'page'     => ServicePage::current(),
        'services' => Service::active()->get(),
    ]);
});

// 4. Detail layanan  -> resources/views/frontend/layanan/show.blade.php
Route::get('/layanan/{slug}', function (string $slug) {
    $layanan = Service::active()->where('slug', $slug)->firstOrFail();

    return view('frontend.layanan.show', compact('layanan'));
});

// 5. Galeri  -> resources/views/galeri.blade.php
Route::get('/galeri', function () {
    return view('galeri', [
        'galleries' => Gallery::active()->get(),
        'page'      => GalleryPage::current(),
    ]);
});

// 6. Kontak  -> resources/views/kontak.blade.php
Route::get('/kontak', function () {
    return view('kontak', [
        'page'    => ContactPage::current(),
        'setting' => SiteSetting::current(),
    ]);
});

// 7. Simpan pesan dari form kontak (masuk ke menu "Pesan Masuk" di admin)
Route::post('/kontak', function (Request $request) {
    $data = $request->validate(
        [
            'nama'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'subjek'  => ['nullable', 'string', 'max:255'],
            'pesan'   => ['required', 'string', 'max:5000'],
        ],
        [
            'required' => ':attribute wajib diisi.',
            'email'    => 'Format :attribute belum benar.',
            'max'      => ':attribute terlalu panjang.',
        ],
        [
            'nama'    => 'Nama lengkap/instansi',
            'email'   => 'Alamat email',
            'telepon' => 'Nomor telepon/WhatsApp',
            'subjek'  => 'Sektor / subjek kebutuhan',
            'pesan'   => 'Rincian kebutuhan',
        ]
    );

    Message::create([
        'name'    => $data['nama'],
        'email'   => $data['email'],
        'phone'   => $data['telepon'] ?? null,
        'subject' => $data['subjek'] ?? null,
        'body'    => $data['pesan'],
    ]);

    return back()->with('sukses', ContactPage::current()->form_success ?: 'Terima kasih, pesan Anda sudah kami terima.');
});