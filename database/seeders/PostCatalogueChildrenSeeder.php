<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PostCatalogueChildrenSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('post_catalogue_children')->insert([
            ['post_catalogue_parent_id' => 1, 'post_catalogue_children_name' => 'Chính trị', 'post_catalogue_children_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_id' => 1, 'post_catalogue_children_name' => 'Dân sinh', 'post_catalogue_children_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_id' => 1, 'post_catalogue_children_name' => 'Lao động - Việc làm', 'post_catalogue_children_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_id' => 2, 'post_catalogue_children_name' => 'Chính trị - Chính sách', 'post_catalogue_children_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_id' => 1, 'post_catalogue_children_name' => 'Giao thông', 'post_catalogue_children_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_id' => 1, 'post_catalogue_children_name' => 'Mekong', 'post_catalogue_children_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_id' => 1, 'post_catalogue_children_name' => 'Quỳ Hy Vọng', 'post_catalogue_children_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
