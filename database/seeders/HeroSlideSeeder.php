<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSlide::create([
            'title' => 'Eucalyptus-powered care for cleaner, healthier living.',
            'caption' => 'Discover our portfolio of detergents and cosmetics crafted with natural botanicals and trusted science. Highlighting our signature eucalyptus-based soaps for homes and businesses across Ethiopia.',
            'image_path' => 'assets/IMG_6745.JPG',
            'button_primary_label' => 'Explore Products',
            'button_primary_url' => '#products',
            'button_secondary_label' => 'Chat on WhatsApp',
            'button_secondary_url' => 'https://wa.me/251931674207',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        HeroSlide::create([
            'title' => 'Innovative Manufacturing Solutions',
            'caption' => 'Leading the industry with cutting-edge technology and sustainable practices',
            'image_path' => 'assets/hero1.jpg',
            'button_primary_label' => 'Our Products',
            'button_primary_url' => '/products',
            'button_secondary_label' => 'Learn More',
            'button_secondary_url' => '/about',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        HeroSlide::create([
            'title' => 'Quality Engineering Excellence',
            'caption' => 'Decades of experience delivering precision manufacturing solutions',
            'image_path' => 'assets/hero2.jpg',
            'button_primary_label' => 'View Portfolio',
            'button_primary_url' => '/products',
            'button_secondary_label' => 'Contact Us',
            'button_secondary_url' => '/contact',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        HeroSlide::create([
            'title' => 'Sustainable Manufacturing',
            'caption' => 'Committed to environmental responsibility and green manufacturing',
            'image_path' => 'assets/hero3.jpg',
            'button_primary_label' => 'Our Approach',
            'button_primary_url' => '/about',
            'is_active' => true,
            'sort_order' => 4,
        ]);
    }
}
