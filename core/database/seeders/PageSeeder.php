<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $templateName = activeTemplateName();

        $pages = [
            ['title' => 'Home', 'name' => 'Home', 'slug' => '/', 'is_default' => 1],
            ['title' => 'About Us', 'name' => 'About Us', 'slug' => 'about-us'],
            ['title' => 'Contact Us', 'name' => 'Contact Us', 'slug' => 'contact'],
            ['title' => 'Terms & Conditions', 'name' => 'Terms & Conditions', 'slug' => 'terms-conditions'],
            ['title' => 'Privacy Policy', 'name' => 'Privacy Policy', 'slug' => 'privacy-policy'],
            ['title' => 'FAQ', 'name' => 'FAQ', 'slug' => 'faq'],
            ['title' => 'Packages', 'name' => 'Packages', 'slug' => 'packages'],
            ['title' => 'Stories', 'name' => 'Stories', 'slug' => 'stories'],
        ];

        foreach ($pages as $page) {
            $page['tempname'] = 'templates.' . $templateName . '.';
            Page::firstOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
