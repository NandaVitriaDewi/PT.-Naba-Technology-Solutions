<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'photo',
        'list_title', 'list_excerpt', 'list_photo',
        'detail_title', 'detail_photo',
        'subtitle', 'summary',
        'standard_title', 'standard_intro', 'points',
        'cta_title', 'cta_text', 'cta_button',
        'sort_order', 'is_active',
    ];

    protected static function booted(): void
    {
        // Otomatis bikin slug unik sebelum data disimpan
        static::saving(function (Service $service) {
            if (empty($service->slug)) {
                $base = Str::slug($service->title) ?: 'layanan';
                $slug = $base;
                $i = 2;
                // Cek kalau slug udah ada di database, tambahin angka di belakangnya
                while (static::where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $service->slug = $slug;
            }
        });
    }

    protected function casts(): array
    {
        return [
            'points'    => 'array',
            'is_active' => 'boolean',
        ];
    }

    // Hanya yang aktif, urut sesuai sort_order
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    // Foto kartu di beranda
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    // Foto kartu di halaman /layanan (kalau kosong, pakai foto beranda)
    public function getListPhotoUrlAttribute(): ?string
    {
        return $this->list_photo ? asset('storage/' . $this->list_photo) : $this->photo_url;
    }

    // Foto di halaman detail (kalau kosong, pakai foto beranda)
    public function getDetailPhotoUrlAttribute(): ?string
    {
        return $this->detail_photo ? asset('storage/' . $this->detail_photo) : $this->photo_url;
    }
}