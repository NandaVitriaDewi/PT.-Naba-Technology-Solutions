<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function log(string $subject, string $description): ActivityLog
    {
        return ActivityLog::create([
            'user_id'     => auth()->id() ?? 1,
            'subject'     => $subject,
            'description' => $description,
            // old_values & new_values dibiarkan null
        ]);
    }
}