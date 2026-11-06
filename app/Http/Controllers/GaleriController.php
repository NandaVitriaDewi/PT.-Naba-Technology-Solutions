<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryPage;

class GaleriController extends Controller
{
    public function index()
    {
        return view('galeri', [
            'galleries' => Gallery::active()->get(),
            'page'      => GalleryPage::current(),
        ]);
    }
}