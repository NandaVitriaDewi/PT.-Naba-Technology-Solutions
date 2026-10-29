<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_contents', function (Blueprint $table) {
    $table->id();

    // Hero
    $table->string('hero_badge')->nullable();
    $table->string('hero_title');
    $table->text('hero_text');
    $table->string('hero_button')->nullable();
    $table->string('hero_image')->nullable();

    // Statistik (3 angka)
    $table->json('stats')->nullable();

    // Tentang
    $table->string('about_title');
    $table->text('about_text');
    $table->string('about_button')->nullable();
    $table->string('about_image')->nullable();

    // Katalog
    $table->string('catalog_title');
    $table->text('catalog_text');
    $table->string('catalog_button')->nullable();

    // Alur pengadaan
    $table->string('process_title');
    $table->text('process_intro');
    $table->json('process_steps')->nullable();
    $table->string('process_image_1')->nullable();
    $table->string('process_image_2')->nullable();

    // Galeri
    $table->string('gallery_title');
    $table->string('gallery_caption')->nullable();

    // Ajakan (CTA)
    $table->string('cta_title');
    $table->text('cta_text');
    $table->string('cta_button')->nullable();

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
