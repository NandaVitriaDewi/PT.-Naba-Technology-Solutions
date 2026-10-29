<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = [
        'badge', 'title', 'intro',
        'info_title', 'info_text', 'map_embed_url',
        'form_label', 'form_title', 'form_intro', 'form_button', 'form_note', 'form_success',
    ];

    // Hanya ada satu baris isi halaman Kontak
    public static function current(): self
    {
        return static::first() ?? new static();
    }
}