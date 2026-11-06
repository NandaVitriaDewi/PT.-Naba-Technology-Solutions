<?php

namespace App\Http\Controllers;

use App\Models\ContactPage;
use App\Models\Message;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak', [
            'page'    => ContactPage::current(),
            'setting' => SiteSetting::current(),
        ]);
    }

    public function store(Request $request)
    {
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

        $waAdmin = '6282340153055'; 
        
        $teksWA = "Halo Admin PT Naba, saya *{$data['nama']}* ingin bertanya.\n\n";
        $teksWA .= "Email: {$data['email']}\n";
        $teksWA .= "Telepon: " . ($data['telepon'] ?? '-') . "\n";
        $teksWA .= "Subjek: " . ($data['subjek'] ?? '-') . "\n\n";
        $teksWA .= "Pesan:\n{$data['pesan']}";
        
        $waLink = "https://wa.me/{$waAdmin}?text=" . urlencode($teksWA);

        return back()
            ->with('sukses', 'Terima kasih, pesan Anda sudah kami terima.')
            ->with('wa_link', $waLink);
    }
}