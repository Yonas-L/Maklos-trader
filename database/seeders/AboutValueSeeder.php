<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use App\Models\AboutValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutContent = AboutContent::first();

        AboutValue::create([
            'about_content_id' => $aboutContent->id,
            'type' => 'mission',
            'title' => 'Customer-Centric Approach',
            'badge' => 'Excellence',
            'summary' => 'We prioritize customer satisfaction in every project we undertake.',
            'details' => json_encode([
                'point1' => '24/7 customer support',
                'point2' => 'Customized solutions',
                'point3' => 'On-time delivery guarantee'
            ]),
            'accent_color' => 'blue',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        AboutValue::create([
            'about_content_id' => $aboutContent->id,
            'type' => 'vision',
            'title' => 'Innovation Leadership',
            'badge' => 'Innovation',
            'summary' => 'Continuously pushing the boundaries of manufacturing technology.',
            'details' => json_encode([
                'point1' => 'R&D investment',
                'point2' => 'Cutting-edge equipment',
                'point3' => 'Continuous improvement'
            ]),
            'accent_color' => 'green',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        AboutValue::create([
            'about_content_id' => $aboutContent->id,
            'type' => 'values',
            'title' => 'Quality Commitment',
            'badge' => 'Quality',
            'summary' => 'Uncompromising quality standards in every product we deliver.',
            'details' => json_encode([
                'point1' => 'ISO 9001 certified',
                'point2' => 'Zero-defect goal',
                'point3' => 'Rigorous testing protocols'
            ]),
            'accent_color' => 'purple',
            'is_active' => true,
            'sort_order' => 3,
        ]);
    }
}
