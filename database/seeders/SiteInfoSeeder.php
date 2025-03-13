<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteInfo;

class SiteInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteInfo::updateOrCreate([
            'site_name' => 'Medilab',
            'email' => 'info@example.com',
            'phone' => '+1 5589 55488 55',
            'address' => 'A108 Adam Street,<br>New York, NY 535022',
            'copyright_text' => '© Copyright Medilab All Rights Reserved',
            'socials' => json_encode([
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'instagram' => 'https://instagram.com',
                'linkedin' => 'https://linkedin.com',
            ])
        ]);
    }
}
