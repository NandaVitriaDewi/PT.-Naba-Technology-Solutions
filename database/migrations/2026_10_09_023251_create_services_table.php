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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');                 // teks singkat di kartu beranda
            $table->text('subtitle');                // teks di banner halaman detail
            $table->text('summary');                 // ringkasan ruang lingkup pasokan
            $table->text('standard_intro');          // kalimat pengantar standar kualitas
            $table->json('points')->nullable();      // 4 poin standar (judul + isi)
            $table->string('photo')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};