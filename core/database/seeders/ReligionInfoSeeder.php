<?php

namespace Database\Seeders;

use App\Models\ReligionInfo;
use Illuminate\Database\Seeder;

class ReligionInfoSeeder extends Seeder
{
    public function run(): void
    {
        $religions = [
            'Islam',
            'Hinduism',
            'Christianity',
            'Buddhism',
            'Sikhism',
            'Judaism',
            'Jainism',
            'Bahai Faith',
            'Taoism',
            'Confucianism',
            'Shinto',
            'Other',
        ];

        foreach ($religions as $religion) {
            ReligionInfo::firstOrCreate(['name' => $religion]);
        }
    }
}
