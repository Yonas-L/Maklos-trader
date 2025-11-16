<?php

namespace Database\Seeders;

use App\Models\ManufacturingStep;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturingStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ManufacturingStep::create([
            'step_number' => '01',
            'badge' => 'Design',
            'title' => 'Concept & Design',
            'description' => 'Our engineering team works closely with clients to develop detailed designs and specifications tailored to their requirements.',
            'features' => json_encode([
                'CAD modeling',
                'FEA analysis',
                'Material selection',
                'Prototyping'
            ]),
            'image_path' => 'assets/manufacturing/design.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        ManufacturingStep::create([
            'step_number' => '02',
            'badge' => 'Planning',
            'title' => 'Production Planning',
            'description' => 'Comprehensive planning ensures optimal resource allocation, timeline management, and quality control throughout the manufacturing process.',
            'features' => json_encode([
                'Resource allocation',
                'Timeline optimization',
                'Quality planning',
                'Risk assessment'
            ]),
            'image_path' => 'assets/manufacturing/planning.jpg',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        ManufacturingStep::create([
            'step_number' => '03',
            'badge' => 'Manufacturing',
            'title' => 'Precision Manufacturing',
            'description' => 'State-of-the-art equipment and skilled technicians ensure precision manufacturing to exact specifications.',
            'features' => json_encode([
                'CNC machining',
                'Quality inspection',
                'Process monitoring',
                'Documentation'
            ]),
            'image_path' => 'assets/manufacturing/manufacturing.jpg',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        ManufacturingStep::create([
            'step_number' => '04',
            'badge' => 'Quality',
            'title' => 'Quality Assurance',
            'description' => 'Rigorous testing and inspection processes ensure every product meets our exacting quality standards.',
            'features' => json_encode([
                'Dimensional inspection',
                'Material testing',
                'Performance validation',
                'Documentation'
            ]),
            'image_path' => 'assets/manufacturing/quality.jpg',
            'is_active' => true,
            'sort_order' => 4,
        ]);
    }
}
