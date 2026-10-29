<?php

namespace Database\Seeders;

use App\Models\HeaderSetting;
use Illuminate\Database\Seeder;

class HeaderSettingSeeder extends Seeder
{
    public function run(): void
    {
        HeaderSetting::firstOrCreate([], [
            'menu_items' => [
                ['label' => 'Beranda',      'url' => '/',             'submenu' => false],
                ['label' => 'Tentang Kami', 'url' => '/tentang-kami', 'submenu' => false],
                ['label' => 'Layanan',      'url' => '/layanan',      'submenu' => true],
                ['label' => 'Galeri',       'url' => '/galeri',       'submenu' => false],
            ],
            'button_label' => 'Kontak',
            'button_url'   => '/kontak',
        ]);
    }
}