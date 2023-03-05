<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Scan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'tina',
            'email' => 'tina@example.com',
            'password' => bcrypt('1')
        ]);

        $scan = \App\Models\Scan::factory(1)->create()->first();
        \App\Models\Customer::factory(20)->create([
            'scan_id' => $scan->id
        ]);

    }
}
