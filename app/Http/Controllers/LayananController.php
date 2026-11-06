<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServicePage;

class LayananController extends Controller
{
    // Halaman daftar layanan (/layanan)
    public function index()
    {
        return view('layanan', [
            'page'     => ServicePage::current(),
            'services' => Service::active()->get(),
        ]);
    }

    // Halaman detail layanan (/layanan/{slug})
    public function show(string $slug)
    {
        $layanan = Service::active()->where('slug', $slug)->firstOrFail();
        return view('frontend.layanan.show', compact('layanan'));
    }
}