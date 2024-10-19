<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('customers')->insert([
            [
                'cus_user' => 'customer1',
                'cus_pass' => bcrypt('123456'), 
                'email' => 'customer1@example.com',
                'verify_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cus_user' => 'customer2',
                'cus_pass' => bcrypt('123456'),
                'email' => 'customer2@example.com',
                'verify_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
