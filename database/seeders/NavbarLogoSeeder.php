<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class NavbarLogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'navbar_logo'],
            [
                'value' => 'assets/LOGO/logo2.png',
                'type' => 'image',
                'meta' => json_encode([
                    'label' => 'Navbar Logo',
                    'description' => 'Logo displayed in the navigation bar',
                    'max_size' => 2048, // 2MB in KB
                    'accepted_types' => ['png', 'jpg', 'jpeg', 'svg', 'webp'],
                ]),
            ]
        );
    }
}
