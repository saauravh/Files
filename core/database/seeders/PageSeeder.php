<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['title' => 'About Us',  'slug' => 'about-us'],
            ['title' => 'Contact Us', 'slug' => 'contact-us'],
            ['title' => 'Terms & Conditions', 'slug' => 'terms-conditions'],
            ['title' => 'Privacy Policy', 'slug' => 'privacy-policy'],
            ['title' => 'FAQ', 'slug' => 'faq'],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
