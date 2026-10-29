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
        Schema::create('footer_settings', function (Blueprint $table) {
    $table->id();

    // 1. Profil perusahaan
    $table->string('logo')->nullable();
    $table->string('tagline')->nullable();
    $table->text('description')->nullable();
    $table->json('badges')->nullable();

    // 2. Bidang layanan
    $table->string('services_title')->nullable();

    // 3. Navigasi
    $table->string('nav_title')->nullable();
    $table->json('nav_links')->nullable();

    // 4. Kantor pusat
    $table->string('office_title')->nullable();

    // 5. Baris bawah
    $table->string('copyright')->nullable();

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_settings');
    }
};
