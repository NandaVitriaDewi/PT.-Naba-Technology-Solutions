<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'company_name', 'address', 'phone', 'whatsapp',
        'email', 'hours', 'hours_note',
    ];

    // Ambil satu-satunya baris pengaturan: SiteSetting::current()
    public static function current(): self
    {
        return static::first() ?? new static();
    }
}