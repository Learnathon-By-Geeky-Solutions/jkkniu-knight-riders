<?php

namespace Database\Seeders;

use App\Models\CMS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;

class HomeBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMS::updateOrCreate([
            'page' => PageEnum::HOME->value,
            'section' => SectionEnum::HOME_BANNER->value,
            'title' => 'WELCOME TO MEDILAB',
            'sub_title' => 'We are team of talented designers making websites with Bootstrap.',
            'image' => 'assets/img/hero-bg.jpg',
        ]);
    }
}
