<?php

namespace App\Filament\Concerns;

use App\Services\ActivityLogger;

trait LogsActivityOnSave
{
    protected function afterSave(): void
    {
        // Cek apakah ada perubahan data dari form
        if (! $this->record->wasChanged()) {
            return;
        }

        $subject = property_exists($this, 'activitySubject') 
            ? $this->activitySubject 
            : class_basename($this->record);

        $description = property_exists($this, 'activityDescription') 
            ? $this->activityDescription 
            : 'Memperbarui ' . $subject;

        // Simpan log TANPA old_values dan new_values (biar gak pusing)
        ActivityLogger::log($subject, $description);
    }
}