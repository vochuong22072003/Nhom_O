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
                'email' => 'c1@edu.com',
                'verify_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cus_user' => 'customer2',
                'cus_pass' => bcrypt('123456'),
                'email' => 'c2@edu.com',
                'verify_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cus_user' => 'customer3',
                'cus_pass' => bcrypt('123456'),
                'email' => 'c3@edu.com',
                'verify_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cus_user' => 'owo',
                'cus_pass' => bcrypt('123456'),
                'email' => '22211tt0596@mail.tdc.edu.vn',
                'verify_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
