<?php

namespace App\Http\Controllers;

use App\Models\HomeContent;
use App\Models\Service;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        return view('beranda', [
            'home'      => HomeContent::current(),
            'services'  => Service::active()->get(),
            'galleries' => Gallery::active()->take(4)->get(),
        ]);
    }
}