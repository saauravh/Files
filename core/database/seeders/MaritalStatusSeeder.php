<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Never Married', 'Married', 'Divorced', 'Widowed', 'Separated', 'Annulled'];

        foreach ($statuses as $status) {
            MaritalStatus::firstOrCreate(['title' => $status]);
        }
    }
}
