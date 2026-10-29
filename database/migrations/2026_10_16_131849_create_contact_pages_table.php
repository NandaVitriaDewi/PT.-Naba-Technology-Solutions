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
        Schema::create('contact_pages', function (Blueprint $table) {
    $table->id();

    // 1. Banner
    $table->string('badge')->nullable();
    $table->string('title');
    $table->text('intro')->nullable();

    // 2. Informasi kontak & peta
    $table->string('info_title');
    $table->text('info_text')->nullable();
    $table->text('map_embed_url')->nullable();

    // 3. Formulir pesan
    $table->string('form_label')->nullable();
    $table->string('form_title');
    $table->text('form_intro')->nullable();
    $table->string('form_button')->nullable();
    $table->text('form_note')->nullable();
    $table->string('form_success')->nullable();

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
