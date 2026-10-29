<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePage extends Model
{
    protected $fillable = ['badge', 'title', 'intro', 'list_title', 'list_text', 'card_link_text'];

    // Hanya ada satu baris isi halaman Layanan
    public static function current(): self
    {
        return static::first() ?? new static();
    }
}