<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPage extends Model
{
    protected $fillable = [
        'badge', 'title', 'intro', 'photos',
        'cta_title', 'cta_text', 'cta_button', 'cta_url',
    ];

    protected function casts(): array
    {
        return ['photos' => 'array'];
    }

    // Hanya ada satu baris isi halaman Galeri
    public static function current(): self
    {
        return static::first() ?? new static();
    }

    // Daftar foto: [['url' => ..., 'title' => ...], ...] sesuai urutan di admin
    public function items(): array
    {
        return collect($this->photos ?? [])
            ->values()
            ->map(function ($item) {
                $path  = is_array($item) ? ($item['image'] ?? null) : $item;
                $title = is_array($item) ? ($item['title'] ?? '') : '';

                // Jaga-jaga kalau hasil upload berbentuk array
                if (is_array($path)) {
                    $path = array_values($path)[0] ?? null;
                }

                return $path
                    ? ['url' => asset('storage/' . $path), 'title' => $title]
                    : null;
            })
            ->filter()
            ->values()
            ->all();
    }
}