<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_pages', function (Blueprint $table) {
            if (! Schema::hasColumn('gallery_pages', 'badge')) {
                $table->string('badge')->nullable()->after('id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('gallery_pages', function (Blueprint $table) {
            if (Schema::hasColumn('gallery_pages', 'badge')) {
                $table->dropColumn('badge');
            }
        });
    }
};