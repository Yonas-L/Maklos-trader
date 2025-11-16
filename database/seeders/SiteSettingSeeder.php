<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'key' => 'site_name',
            'value' => 'Maklos Manufacturing',
            'type' => 'text',
        ]);

        SiteSetting::create([
            'key' => 'site_description',
            'value' => 'Leading manufacturing solutions provider with precision engineering and innovative technology',
            'type' => 'textarea',
        ]);

        SiteSetting::create([
            'key' => 'contact_email',
            'value' => 'info@maklos.com',
            'type' => 'email',
        ]);

        SiteSetting::create([
            'key' => 'contact_phone',
            'value' => '+1 (555) 123-4567',
            'type' => 'tel',
        ]);

        SiteSetting::create([
            'key' => 'contact_address',
            'value' => '123 Industrial Boulevard, Manufacturing City, MC 12345',
            'type' => 'textarea',
        ]);

        SiteSetting::create([
            'key' => 'social_facebook',
            'value' => 'https://facebook.com/maklos',
            'type' => 'url',
        ]);

        SiteSetting::create([
            'key' => 'social_linkedin',
            'value' => 'https://linkedin.com/company/maklos',
            'type' => 'url',
        ]);

        SiteSetting::create([
            'key' => 'social_twitter',
            'value' => 'https://twitter.com/maklos',
            'type' => 'url',
        ]);

        SiteSetting::create([
            'key' => 'google_analytics_id',
            'value' => 'G-XXXXXXXXXX',
            'type' => 'text',
        ]);

        SiteSetting::create([
            'key' => 'maintenance_mode',
            'value' => 'false',
            'type' => 'boolean',
        ]);
    }
}
