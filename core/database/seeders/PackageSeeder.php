<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::firstOrCreate(['name' => 'Free'], [
            'amount'                  => 0,
            'interest_express_limit'  => 5,
            'contact_view_limit'      => 3,
            'image_upload_limit'      => 3,
            'validity_period'         => 30,
            'status'                  => 1,
        ]);

        Package::firstOrCreate(['name' => 'Basic'], [
            'amount'                  => 9.99,
            'interest_express_limit'  => 25,
            'contact_view_limit'      => 20,
            'image_upload_limit'      => 10,
            'validity_period'         => 30,
            'status'                  => 1,
        ]);

        Package::firstOrCreate(['name' => 'Premium'], [
            'amount'                  => 29.99,
            'interest_express_limit'  => -1,
            'contact_view_limit'      => -1,
            'image_upload_limit'      => 50,
            'validity_period'         => 90,
            'status'                  => 1,
        ]);
    }
}
