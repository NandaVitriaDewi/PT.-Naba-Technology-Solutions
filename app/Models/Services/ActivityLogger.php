<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ActivityLogger
{
    public static function log(
        string $subject,
        string $description,
        ?Model $model = null,
        array $old = [],
        array $new = []
    ): ActivityLog {
        return ActivityLog::create([
            'user_id'     => auth()->id(),
            'subject'     => $subject,
            'description' => $description,
            'old_values'  => $old ?: null,
            'new_values'  => $new ?: null,
        ]);
    }

    public static function diff(array $before, array $after): array
    {
        $old = [];
        $new = [];

        $keys = array_unique(array_merge(array_keys($before), array_keys($after)));

        foreach ($keys as $key) {
            $b = $before[$key] ?? null;
            $a = $after[$key] ?? null;

            if (json_encode($b) === json_encode($a)) {
                continue;
            }

            $old[$key] = $b;
            $new[$key] = $a;
        }

        return [$old, $new];
    }
}