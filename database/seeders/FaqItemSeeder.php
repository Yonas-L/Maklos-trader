<?php

namespace Database\Seeders;

use App\Models\FaqItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FaqItem::create([
            'category' => 'General',
            'question' => 'What industries do you serve?',
            'answer' => 'We serve a wide range of industries including aerospace, automotive, medical devices, electronics, and industrial manufacturing. Our expertise spans across various sectors requiring precision engineering and manufacturing.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        FaqItem::create([
            'category' => 'Services',
            'question' => 'What is your typical lead time?',
            'answer' => 'Lead times vary depending on project complexity and volume. Standard orders typically range from 2-4 weeks, while complex projects may require 6-8 weeks. We always provide accurate timelines during the quoting process.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        FaqItem::create([
            'category' => 'Quality',
            'question' => 'Are you ISO certified?',
            'answer' => 'Yes, we are ISO 9001:2015 certified and maintain rigorous quality management systems. We also hold various industry-specific certifications and comply with all relevant regulatory requirements.',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        FaqItem::create([
            'category' => 'Technical',
            'question' => 'What materials can you work with?',
            'answer' => 'We work with a comprehensive range of materials including aluminum, steel, stainless steel, titanium, brass, copper, and various engineering plastics. Our team can recommend the best material for your specific application.',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        FaqItem::create([
            'category' => 'Services',
            'question' => 'Do you offer prototyping services?',
            'answer' => 'Yes, we offer comprehensive prototyping services including rapid prototyping, low-volume production, and design validation. Our prototyping capabilities help you test and refine designs before full-scale production.',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        FaqItem::create([
            'category' => 'General',
            'question' => 'How do I request a quote?',
            'answer' => 'You can request a quote by contacting our sales team through phone, email, or our website\'s contact form. Please provide detailed specifications, drawings, and quantity requirements for accurate pricing.',
            'sort_order' => 6,
            'is_active' => true,
        ]);
    }
}
