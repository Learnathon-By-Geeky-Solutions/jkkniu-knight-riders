<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CMS;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;

class HomeBannerWhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMS::updateOrCreate([
            'page' => PageEnum::HOME->value,
            'section' => SectionEnum::HOME_BANNER_WHY_CHOOSE_US->value,
            'title' => 'Why Choose Medilab?',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'btn_text' => 'Learn More',
        ]);
    }
}
