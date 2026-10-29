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
    Schema::create('header_settings', function (Blueprint $table) {
    $table->id();

    // 1. Logo
    $table->string('logo')->nullable();

    // 2. Menu navigasi
    $table->json('menu_items')->nullable();

    // 3. Tombol di kanan
    $table->string('button_label')->nullable();
    $table->string('button_url')->nullable();

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_settings');
    }
};
