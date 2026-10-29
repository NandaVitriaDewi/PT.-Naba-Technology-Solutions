<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    // Kolom baru di tabel services (hanya ditambah kalau belum ada)
    private array $kolom = [
        'list_title', 'list_excerpt', 'list_photo',
        'detail_title', 'detail_photo',
        'standard_title', 'cta_title', 'cta_text', 'cta_button',
    ];

    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'list_title'))     $table->string('list_title')->nullable();
            if (! Schema::hasColumn('services', 'list_excerpt'))   $table->text('list_excerpt')->nullable();
            if (! Schema::hasColumn('services', 'list_photo'))     $table->string('list_photo')->nullable();
            if (! Schema::hasColumn('services', 'detail_title'))   $table->string('detail_title')->nullable();
            if (! Schema::hasColumn('services', 'detail_photo'))   $table->string('detail_photo')->nullable();
            if (! Schema::hasColumn('services', 'standard_title')) $table->string('standard_title')->nullable();
            if (! Schema::hasColumn('services', 'cta_title'))      $table->string('cta_title')->nullable();
            if (! Schema::hasColumn('services', 'cta_text'))       $table->string('cta_text', 500)->nullable();
            if (! Schema::hasColumn('services', 'cta_button'))     $table->string('cta_button')->nullable();
        });

        Schema::table('service_pages', function (Blueprint $table) {
            if (! Schema::hasColumn('service_pages', 'card_link_text')) {
                $table->string('card_link_text')->default('Rincian & Spesifikasi');
            }
        });

        // Isi awal: salin teks dan foto yang sekarang ke kolom baru (hanya yang masih kosong)
        $disk = Storage::disk('public');

        foreach (DB::table('services')->get() as $s) {
            $isi = [];

            if (blank($s->list_title))      $isi['list_title']      = $s->title;
            if (blank($s->list_excerpt))    $isi['list_excerpt']    = $s->excerpt;
            if (blank($s->detail_title))    $isi['detail_title']    = $s->title;
            if (blank($s->standard_title))  $isi['standard_title']  = 'Standar Kendali Mutu & Jaminan';
            if (blank($s->cta_title))       $isi['cta_title']       = 'Butuh Penawaran Pengadaan?';
            if (blank($s->cta_text))        $isi['cta_text']        = 'Tim teknis dan legalitas PT Naba Technology Solutions siap membantu pemenuhan kualifikasi tender dan spesifikasi instansi Anda.';
            if (blank($s->cta_button))      $isi['cta_button']      = 'Hubungi Tim Marketing';

            // Foto: tiap halaman dapat salinan file sendiri, supaya ganti satu tidak mengubah yang lain
            if ($s->photo && $disk->exists($s->photo)) {
                $nama = basename($s->photo);

                foreach (['list_photo' => 'list-', 'detail_photo' => 'detail-'] as $kolom => $awalan) {
                    if (blank($s->{$kolom})) {
                        $tujuan = 'services/' . $awalan . $nama;

                        if (! $disk->exists($tujuan)) {
                            $disk->copy($s->photo, $tujuan);
                        }

                        $isi[$kolom] = $tujuan;
                    }
                }
            }

            if ($isi) {
                DB::table('services')->where('id', $s->id)->update($isi);
            }
        }
    }

    public function down(): void
    {
        foreach ($this->kolom as $nama) {
            if (Schema::hasColumn('services', $nama)) {
                Schema::table('services', fn (Blueprint $table) => $table->dropColumn($nama));
            }
        }

        if (Schema::hasColumn('service_pages', 'card_link_text')) {
            Schema::table('service_pages', fn (Blueprint $table) => $table->dropColumn('card_link_text'));
        }
    }
};