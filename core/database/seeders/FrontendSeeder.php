<?php

namespace Database\Seeders;

use App\Models\Frontend;
use Illuminate\Database\Seeder;

class FrontendSeeder extends Seeder
{
    public function run(): void
    {
        $frontends = [
            [
                'data_keys'   => 'seo.data',
                'data_values' => [
                    'keywords'          => ['matrimony', 'marriage', 'dating', 'relationship'],
                    'description'       => 'Find your perfect life partner on MatrimonyLab',
                    'social_title'      => 'MatrimonyLab - Find Your Perfect Match',
                    'social_description' => 'MatrimonyLab is a modern matrimonial platform',
                    'image'             => null,
                ],
            ],
            [
                'data_keys'   => 'maintenance.data',
                'data_values' => [
                    'description' => 'We are currently performing scheduled maintenance. Please check back later.',
                    'image'       => null,
                ],
            ],
            [
                'data_keys'   => 'cookie.data',
                'data_values' => [
                    'short_desc'  => 'We use cookies to improve your experience.',
                    'description' => '<p>We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.</p>',
                    'status'      => 1,
                ],
            ],
            [
                'data_keys'   => 'basic.data',
                'data_values' => (object)[
                    'about'         => 'MatrimonyLab is a trusted matrimonial platform helping people find their perfect life partner.',
                    'contact_email' => 'support@example.com',
                    'contact_phone' => '+1 234 567 890',
                    'contact_address' => '123 Main Street, City, Country',
                ],
            ],
        ];

        foreach ($frontends as $frontend) {
            Frontend::firstOrCreate(
                ['data_keys' => $frontend['data_keys']],
                [
                    'data_values' => $frontend['data_values'],
                    'tempname'    => 'basic',
                ]
            );
        }
    }
}
