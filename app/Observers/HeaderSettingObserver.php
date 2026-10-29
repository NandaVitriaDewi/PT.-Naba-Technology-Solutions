<?php

namespace App\Observers;

use App\Models\HeaderSetting; // Sesuaikan sama nama Model lo
use App\Services\ActivityLogger;

class HeaderSettingObserver
{
    // Fungsi ini otomatis jalan SETIAP KALI data di database di-UPDATE
    public function updated(HeaderSetting $headerSetting): void
    {
        // isDirty() akan nangkep HANYA kolom yang berubah
        $oldValues = [];
        $newValues = [];

        foreach ($headerSetting->getDirty() as $key => $newValue) {
            // Jangan catat kalau yang berubah cuma tanggal update
            if (in_array($key, ['updated_at', 'created_at'])) {
                continue;
            }

            // getOriginal() adalah data sebelum di-update
            $oldValues[$key] = $headerSetting->getOriginal($key);
            $newValues[$key] = $newValue;
        }

        // Kalau beneran ada perubahan, simpan ke log
        if (!empty($oldValues)) {
            ActivityLogger::log(
                subject: 'Navbar',
                description: 'Memperbarui pengaturan Navbar',
                old: $oldValues,
                new: $newValues
            );
        }
    }
}