<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderSetting extends Model
{
    protected $fillable = ['logo', 'menu_items', 'button_label', 'button_url'];

        protected static function booted()
    {
        static::updating(function ($model) {
            // 1. Ambil data lama persis sebelum disave
            $oldValues = $model->getOriginal();
            $newValues = [];
            $oldDiff = [];

            // 2. Bandingin kolom mana yang beda
            foreach ($model->getDirty() as $key => $newValue) {
                // Skip kolom waktu
                if (in_array($key, ['updated_at', 'created_at', 'id'])) {
                    continue;
                }
                
                $oldDiff[$key] = $oldValues[$key] ?? null;
                $newValues[$key] = $newValue;
            }

            // 3. Kalau ada yang beda, tembak lognya langsung ke Database!
            if (count($newValues) > 0) {
                \App\Models\ActivityLog::create([
                    'user_id' => auth()->id() ?? 1, // fallback ke id 1 kalau auth kosong
                    'subject' => 'Navbar',
                    'description' => 'Memperbarui pengaturan Navbar',
                    'old_values' => $oldDiff,
                    'new_values' => $newValues,
                ]);
            }
        });
    }

    protected function casts(): array
    {
        return ['menu_items' => 'array'];
    }

    // Hanya ada satu baris isi navbar
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