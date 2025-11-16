<?php

namespace Database\Seeders;

use App\Models\ProductHighlight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductHighlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductHighlight::create([
            'label' => 'Featured',
            'title' => 'Precision CNC Machining',
            'description' => 'State-of-the-art CNC machining services with tolerances up to ±0.005mm for complex components across various materials.',
            'slug' => 'precision-cnc-machining',
            'image_path' => 'assets/products/cnc1.jpg',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        ProductHighlight::create([
            'label' => 'Products',
            'title' => 'Industrial Automation Systems',
            'description' => 'Complete automation solutions including PLC programming, HMI design, and robotic integration for manufacturing efficiency.',
            'slug' => 'industrial-automation',
            'image_path' => 'assets/products/automation1.jpg',
            'is_featured' => false,
            'sort_order' => 2,
        ]);

        ProductHighlight::create([
            'label' => 'Products',
            'title' => 'Custom Fabrication',
            'description' => 'Bespoke metal fabrication services including welding, forming, and assembly of custom industrial components.',
            'slug' => 'custom-fabrication',
            'image_path' => 'assets/products/fabrication1.jpg',
            'is_featured' => true,
            'sort_order' => 3,
        ]);

        ProductHighlight::create([
            'label' => 'Products',
            'title' => 'Quality Control Systems',
            'description' => 'Advanced inspection and quality control systems with CMM capabilities and statistical process control.',
            'slug' => 'quality-control',
            'image_path' => 'assets/products/quality1.jpg',
            'is_featured' => false,
            'sort_order' => 4,
        ]);
    }
}
