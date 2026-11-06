<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;

class TentangController extends Controller
{
    public function index()
    {
        return view('frontend.layanan.tentang', [
            'page' => AboutPage::current(),
        ]);
    }
}