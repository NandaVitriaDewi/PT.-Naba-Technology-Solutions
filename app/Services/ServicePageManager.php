<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServicePageManager
{
    public static function syncCards(array $cards): void
    {
        DB::transaction(function () use ($cards) {
            $keptIds = [];

            foreach ($cards as $card) {
                $judul   = trim($card['list_title'] ?? '');
                $teks    = trim($card['list_excerpt'] ?? '');
                $foto    = $card['list_photo'] ?? null;
                $foto    = is_array($foto) ? (array_values($foto)[0] ?? null) : $foto;
                $service = ! empty($card['id']) ? Service::find($card['id']) : null;

                if ($service) {
                    $service->update([
                        'list_title'   => $judul,
                        'list_excerpt' => $teks,
                        'list_photo'   => $foto,
                    ]);
                } else {
                    $service = Service::create([
                        'title'          => $judul,
                        'excerpt'        => $teks,
                        'summary'        => $teks,
                        'subtitle'       => $teks,
                        'standard_intro' => '',
                        'points'         => [],
                        'photo'          => $foto,
                        'list_title'     => $judul,
                        'list_excerpt'   => $teks,
                        'list_photo'     => $foto,
                        'sort_order'     => ((int) Service::max('sort_order')) + 1,
                        'is_active'      => true,
                    ]);
                }

                $keptIds[] = $service->id;
            }

            Service::active()->whereNotIn('id', $keptIds)->get()->each->delete();
        });
    }
}