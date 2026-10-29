<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'hero_badge', 'hero_title', 'hero_text', 'hero_button', 'hero_image',
        'stats',
        'about_title', 'about_text', 'about_button', 'about_image',
        'catalog_title', 'catalog_text', 'catalog_button',
        'process_title', 'process_intro', 'process_steps', 'process_image_1', 'process_image_2',
        'gallery_title', 'gallery_caption',
        'cta_title', 'cta_text', 'cta_button',
    ];

    protected function casts(): array
    {
        return [
            'stats'         => 'array',
            'process_steps' => 'array',
        ];
    }

    // Hanya ada satu baris isi beranda
    public static function current(): self
    {
        return static::first() ?? new static();
    }

    // URL foto dari CMS. Kalau belum diunggah, pakai gambar bawaan di public/assets/img
    public function image(string $field, string $fallback): string
    {
        return $this->{$field}
            ? asset('storage/' . $this->{$field})
            : asset('assets/img/' . $fallback);
    }
}