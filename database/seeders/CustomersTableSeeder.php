<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Scan;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a scan
        $scan = Scan::create();

        // create 10 customers and associate them with the scan
        for ($i = 1; $i <= 10; $i++) {
            Customer::create([
                'isFraud' => false,
                'scan_id' => $scan->id,
            ]);
        }    }
}
