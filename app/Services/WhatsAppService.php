<?php

namespace App\Services;

class WhatsAppService
{
    /**
     * Bikin link WhatsApp otomatis.
     * Otomatis ngubah awalan '0' jadi '62'.
     */
    public static function generateLink(?string $phone, string $message): string
    {
        // Kalau nomor kosong, balikin link kosong atau default
        if (empty($phone)) {
            return '#';
        }

        // Bersihin karakter aneh (spasi, strip, dll)
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Ubah awalan '0' jadi '62'
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }
}