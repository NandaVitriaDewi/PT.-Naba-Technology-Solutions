<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'logo', 'tagline', 'description', 'badges',
        'services_title', 'nav_title', 'nav_links',
        'office_title', 'copyright',
    ];

    protected function casts(): array
    {
        return [
            'badges'    => 'array',
            'nav_links' => 'array',
        ];
    }

    // Hanya ada satu baris isi footer
    public static function current(): self
    {
        return static::first() ?? new static();
    }

    // Logo dari CMS. Kalau belum diunggah, pakai logo bawaan
    public function logoUrl(): string
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : asset('assets/img/logo.png');
    }
}