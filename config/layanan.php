<?php

// Data 5 halaman detail layanan. Kunci (misal 'komputer') = bagian URL: /layanan/komputer
// Nanti dipindah ke database lewat CMS.
return [

    'komputer' => [
        'title'         => 'Perdagangan Besar Komputer & Perlengkapannya',
        'subtitle'      => 'Menyediakan solusi pengadaan komputer, komponen elektronik, dan peralatan operasional berstandar industri dengan jaminan mutu terbaik untuk mendukung kebutuhan proyek instansi Anda.',
        'foto'          => 'hero.jpg',
        'ringkasan'     => 'Pengadaan komputer, komponen elektronik, dan peralatan operasional berstandar industri dengan jaminan mutu terbaik.',
        'standar_intro' => 'Dalam setiap kontrak pengadaan Komputer dan Infrastruktur IT, PT Naba Technology Solutions menerapkan standar kendali mutu ketat yang meliputi:',
        'poin' => [
            ['judul' => 'Prinsipal & Garansi Resmi',  'isi' => 'Perangkat dipasok langsung dari distributor tier-1 dengan jaminan garansi sparepart dan on-site service'],
            ['judul' => 'Test Hardware',              'isi' => 'Pemeriksaan komponen fisik, burn-in test, dan verifikasi kesesuaian spesifikasi sebelum dikirim'],
            ['judul' => 'Kepatuhan Administrasi',     'isi' => 'Kelengkapan faktur pajak resmi, sertifikat garansi, dan dokumen legalitas B2B/B2G'],
            ['judul' => 'Kesiapan Operasional',       'isi' => 'Pendampingan setup OS, instalasi lisensi software, hingga perangkat siap digunakan tanpa kendala teknis'],
        ],
    ],

    'fotografi' => [
        'title'         => 'Perdagangan Besar Alat Fotografi',
        'subtitle'      => 'Menyediakan solusi pengadaan kamera profesional, sistem pencahayaan, dan peralatan videografi berstandar tinggi dengan jaminan garansi resmi untuk mendukung kebutuhan instansi Anda.',
        'foto'          => 'layanan-fotografi.jpg',
        'ringkasan'     => 'Pasokan kamera profesional, lensa presisi tinggi, perangkat pencahayaan studio, drone, serta aksesoris dan periferal fotografi bergaransi resmi.',
        'standar_intro' => 'Guna menjamin keandalan perangkat visual dan performa dokumentasi instansi Anda, kontrol kualitas sektor fotografi PT Naba Technology Solutions mencakup:',
        'poin' => [
            ['judul' => 'Inspeksi Optik & Sensor', 'isi' => 'Pengujian ketajaman elemen kaca lensa, verifikasi kebersihan sensor, serta pengujian fungsionalitas sistem autofocus.'],
            ['judul' => 'Garansi Resmi',           'isi' => 'Seluruh unit bersumber langsung dari distributor resmi dengan jaminan purna jual terjamin.'],
            ['judul' => 'Pengepakan Aman',         'isi' => 'Pengemasan berperedam guncangan untuk keamanan komponen sensitif selama distribusi.'],
            ['judul' => 'Uji Fungsi',              'isi' => 'Pembaharuan perangkat lunak internal ke versi paling stabil serta pendampingan uji coba langsung saat serah terima.'],
        ],
    ],

    'telekomunikasi' => [
        'title'         => 'Perdagangan Besar Peralatan Telekomunikasi',
        'subtitle'      => 'Menyediakan solusi pengadaan perangkat telekomunikasi, sistem jaringan data, dan transmisi radio tersertifikasi resmi untuk menjamin kelancaran konektivitas dan komunikasi operasional instansi Anda.',
        'foto'          => 'layanan-telekomunikasi.jpg',
        'ringkasan'     => 'Penyediaan router enterprise, switch, modem, radio, sistem antenna & penguat sinyal, serta kabel serat optik dan infrastruktur transmisi data terintegrasi.',
        'standar_intro' => 'Guna menjamin kelancaran saluran komunikasi dan transmisi data, kontrol kualitas sektor telekomunikasi PT Naba Technology Solutions mencakup:',
        // DRAFT: di Figma kartu ini masih berisi teks fotografi, jadi 4 poin di bawah gue tulis sendiri. Mohon dicek.
        'poin' => [
            ['judul' => 'Perangkat Bersertifikat', 'isi' => 'Perangkat dipasok dari distributor resmi dengan kelengkapan sertifikasi dan jaminan garansi sesuai ketentuan produsen.'],
            ['judul' => 'Uji Konektivitas',        'isi' => 'Pengujian fungsi jaringan, kekuatan sinyal, dan kestabilan transmisi data sebelum perangkat dikirim.'],
            ['judul' => 'Pengemasan Aman',         'isi' => 'Pengemasan berperedam guncangan untuk melindungi perangkat sensitif selama proses distribusi.'],
            ['judul' => 'Dukungan Teknis',         'isi' => 'Pendampingan konfigurasi awal dan uji coba langsung saat serah terima perangkat.'],
        ],
    ],

    'suku-cadang-elektronik' => [
        'title'         => 'Perdagangan Besar Suku Cadang Elektronik',
        'subtitle'      => 'Menyediakan solusi pengadaan suku cadang elektronik, komponen presisi, dan modul sirkuit berstandar industri dengan jaminan mutu terbaik untuk mendukung kebutuhan pemeliharaan dan operasional perangkat instansi Anda.',
        'foto'          => 'galeri-3.jpg',
        'ringkasan'     => 'Pasokan papan sirkuit, modul sensor industri, unit power supply, konektor presisi, serta suku cadang pengganti bergaransi resmi.',
        'standar_intro' => 'Demi menjamin keandalan pada peralatan utama Anda, kontrol kualitas suku cadang PT Naba Technology Solutions mencakup:',
        'poin' => [
            ['judul' => 'Jaminan Komponen Original', 'isi' => 'Seluruh suku cadang dipasok dari distributor resmi guna menghindari risiko part tiruan.'],
            ['judul' => 'Uji Parametrik & Toleransi', 'isi' => 'Inspeksi presisi daya tahan komponen menggunakan instrumen ukur terkalibrasi sebelum pengiriman.'],
            ['judul' => 'Kemasan Anti-ESD',          'isi' => 'Pengemasan khusus menggunakan kantong Anti-Static ESD Bag untuk melindungi integritas IC/mikrokontroler sensitif.'],
            ['judul' => 'Akurasi Part Number',       'isi' => 'Pencocokan spesifikasi part number secara ketat dan jaminan ganti baru jika terdapat ketidaksesuaian saat integrasi.'],
        ],
    ],

    'peralatan-dapur' => [
        'title'         => 'Perdagangan Besar Peralatan Dapur',
        'subtitle'      => 'Menyediakan solusi pengadaan peralatan dapur komersial, perangkat pengolahan makanan, dan perlengkapan food service berstandar industri dengan jaminan mutu terbaik untuk mendukung kebutuhan operasional instansi Anda.',
        'foto'          => 'galeri-1.jpg',
        'ringkasan'     => 'Pasokan unit pemanas, peralatan fabrikasi stainless steel, pendingin, mesin pengolahan makanan, serta perlengkapan food service berstandar HORECA.',
        'standar_intro' => 'Guna menjamin higienitas, daya tahan, dan keselamatan kerja operasional dapur Anda, kontrol kualitas PT Naba Technology Solutions mencakup:',
        'poin' => [
            ['judul' => 'Material Food Grade',          'isi' => 'Penggunaan bahan stainless steel standar keamanan pangan yang tahan korosi, bebas kontaminasi, dan mudah disterilkan.'],
            ['judul' => 'Sertifikasi Keamanan Gas',     'isi' => 'Verifikasi ketat sistem kelistrikan, katup pengaman gas, serta efisiensi konsumsi energi sebelum pengiriman.'],
            ['judul' => 'Pengemasan Protektif',         'isi' => 'Pelapisan anti-gores dan peti kayu khusus untuk melindungi struktur unit dan komponen sensitif selama distribusi.'],
            ['judul' => 'Uji Fungsi & Kalibrasi Suhu',  'isi' => 'Pengujian performa elemen pemanas/pendingin di lapangan untuk memastikan siap dipakai.'],
        ],
    ],

];