<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('post_views')->insert([
            [
                'post_view_id' => '1',
                'post_id' => '2',
                'view_count' => '3',
                'created_at' => '2024-11-28 13:16:45',
                'updated_at' => '2024-11-28 13:24:32',
            ],
            [
                'post_view_id' => '2',
                'post_id' => '1',
                'view_count' => '4',
                'created_at' => '2024-11-28 13:18:33',
                'updated_at' => '2024-11-28 13:23:53',
            ],
            [
                'post_view_id' => '3',
                'post_id' => '5',
                'view_count' => '1',
                'created_at' => '2024-11-28 14:36:25',
                'updated_at' => '2024-11-28 14:36:25',
            ],
        ]);
    }
}
