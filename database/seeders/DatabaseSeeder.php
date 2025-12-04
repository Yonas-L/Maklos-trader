<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // CMS Seeders
        $this->call([
            HeroSlideSeeder::class,
            HeroContentSeeder::class,
            ProductHighlightSeeder::class,
            ProductSeeder::class,
            AboutContentSeeder::class,
            AboutValueSeeder::class,
            ManufacturingStepSeeder::class,
            FaqItemSeeder::class,
            SiteSettingSeeder::class,
            NavbarLogoSeeder::class,
        ]);
    }
}
