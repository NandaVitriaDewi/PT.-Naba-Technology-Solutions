<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'badge', 'title', 'intro', 'hero_image',
        'history_title', 'history_paragraphs', 'history_image',
        'vision_title', 'vision_text', 'mission_title', 'mission_items',
        'principles_title', 'principles_intro', 'principles',
        'cta_title', 'cta_text', 'cta_button_1', 'cta_button_2',
    ];

    protected function casts(): array
    {
        return [
            'history_paragraphs' => 'array',
            'mission_items'      => 'array',
            'principles'         => 'array',
        ];
    }

    // Hanya ada satu baris isi halaman Tentang Kami
    public static function current(): self
    {
        return static::first() ?? new static();
    }

    // URL foto dari CMS. Kalau belum diunggah, coba gambar bawaan di public/assets/img. Kalau tidak ada, null.
    public function imageUrl(string $field, string $fallback): ?string
    {
        if ($this->{$field}) {
            return asset('storage/' . $this->{$field});
        }

        return file_exists(public_path('assets/img/' . $fallback))
            ? asset('assets/img/' . $fallback)
            : null;
    }
}