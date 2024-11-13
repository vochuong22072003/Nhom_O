<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CustomerInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        $cusIds = \DB::table('customers')->pluck('cus_id')->toArray();

        foreach ($cusIds as $cus) {
            \DB::table('customer_info')->insert([
                'cus_id'     => $cus,
                'cus_name'   => $faker->name,
                'birth_date' => $faker->date,
                'cus_phone'  => $faker->phoneNumber,
                'address'    => $faker->address,
                'gender'     => $faker->randomElement(['Male', 'Female', 'Other']),
                'cus_avt'    => null,
            ]);
        }
    }
}
