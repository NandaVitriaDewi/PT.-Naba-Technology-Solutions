<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    // Halaman Utama Layanan (/layanan)
    public function index()
    {
        $layanan = config('layanan');
        return view('frontend.layanan.index', compact('layanan'));
    }

    // Halaman Detail Layanan (/layanan/{slug})
    public function show($slug)
    {
        $layanan = config("layanan.{$slug}");

        if (!$layanan) {
            abort(404);
        }

        return view('frontend.layanan.show', compact('layanan', 'slug'));
    }
}