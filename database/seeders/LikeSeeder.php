<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('likes')->insert([
            [
                'likes_id' => '1',
                'post_id' => '1',
                'cus_id' => '1',
                'created_at' => '2024-11-27 12:20:05',
                'updated_at' => '2024-11-27 12:20:05',
            ],
            [
                'likes_id' => '2',
                'post_id' => '5',
                'cus_id' => '4',
                'created_at' => '2024-11-27 12:20:05',
                'updated_at' => '2024-11-27 12:20:05',
            ],
            [
                'likes_id' => '3',
                'post_id' => '5',
                'cus_id' => '2',
                'created_at' => '2024-11-28 14:36:18',
                'updated_at' => '2024-11-28 14:36:18',
            ],
        ]);
    }
}
