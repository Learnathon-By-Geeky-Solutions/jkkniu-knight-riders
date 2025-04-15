<?php

namespace Database\Seeders;

use App\Models\CMS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMS::insert([
            [
                'page' => PageEnum::HOME,
                'section' => SectionEnum::WHY_CHOOSE_US,
                'title' => 'Why Choose Us',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ],
            [
                'page' => PageEnum::HOME,
                'section' => SectionEnum::WHY_CHOOSE_US,
                'title' => 'Why Choose Us',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ],
            [
                'page' => PageEnum::HOME,
                'section' => SectionEnum::WHY_CHOOSE_US,
                'title' => 'Why Choose Us',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ]
        ]);
    }
}
