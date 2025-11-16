<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutContent::create([
            'experience_years' => 25,
            'label' => 'About Maklos',
            'headline' => 'Engineering Excellence Since 1998',
            'description' => 'We are a leading manufacturing solutions provider with decades of experience in delivering precision-engineered products and innovative solutions to industries worldwide.',
            'mission_title' => 'Our Mission',
            'mission_description' => 'To deliver exceptional manufacturing solutions that exceed customer expectations through innovation, quality, and sustainable practices.',
            'vision_title' => 'Our Vision',
            'vision_description' => 'To be the global leader in advanced manufacturing, setting industry standards for quality, efficiency, and environmental responsibility.',
            'values_title' => 'Core Values',
            'values_description' => 'Quality, Innovation, Integrity, and Sustainability guide every aspect of our operations and customer relationships.',
        ]);
    }
}
