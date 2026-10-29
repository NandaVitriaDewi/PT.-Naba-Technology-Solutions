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
       Schema::create('about_pages', function (Blueprint $table) {
    $table->id();

        // 1. Banner
        $table->string('badge')->nullable();
        $table->string('title');
        $table->text('intro');
        $table->string('hero_image')->nullable();

        // 2. Sejarah & Dedikasi
        $table->string('history_title');
        $table->json('history_paragraphs')->nullable();
        $table->string('history_image')->nullable();

        // 3. Visi & Misi
        $table->string('vision_title');
        $table->text('vision_text');
        $table->string('mission_title');
        $table->json('mission_items')->nullable();

        // 4. Prinsip kerja
        $table->string('principles_title');
        $table->text('principles_intro')->nullable();
        $table->json('principles')->nullable();

        // 5. Ajakan
        $table->string('cta_title');
        $table->text('cta_text');
        $table->string('cta_button_1')->nullable();
        $table->string('cta_button_2')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
