<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PostCatalogueParentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('post_catalogue_parent')->insert([
            ['post_catalogue_parent_name' => 'Thời sự', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Góc nhìn', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Thế giới', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Kinh doanh', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Bất động sản', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Khoa học', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Giải trí', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Pháp luật', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Giáo dục', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Sức khỏe', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Đời sống', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Du lịch', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Số hóa', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['post_catalogue_parent_name' => 'Xe', 'post_catalogue_parent_description' => null, 'publish' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
