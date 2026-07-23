<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            GeneralSettingSeeder::class,
            BloodGroupSeeder::class,
            MaritalStatusSeeder::class,
            ReligionInfoSeeder::class,
            LanguageSeeder::class,
            PackageSeeder::class,
            GatewaySeeder::class,
            NotificationTemplateSeeder::class,
            FrontendSeeder::class,
            PageSeeder::class,
        ]);
    }
}
