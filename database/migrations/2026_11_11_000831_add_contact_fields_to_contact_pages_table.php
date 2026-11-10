<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('contact_pages', function (Blueprint $table) {
        $table->string('company_name')->nullable();
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->string('whatsapp')->nullable();
        $table->string('email')->nullable();
        $table->string('hours')->nullable();
        $table->string('hours_note')->nullable();
    });
}

public function down(): void
{
    Schema::table('contact_pages', function (Blueprint $table) {
        $table->dropColumn(['company_name', 'address', 'phone', 'whatsapp', 'email', 'hours', 'hours_note']);
    });
}
};
