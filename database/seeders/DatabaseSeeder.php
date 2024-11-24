<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([CustomerSeeder::class, CustomerInfoSeeder::class, UserCatalogueSeeder::class, UserSeeder::class, UserInfoSeeder::class, PermissionSeeder::class, UserCataloguePermissionSeeder::class, PostCatalogueParentSeeder::class, PostCatalogueChildrenSeeder::class, PostSeeder::class, CommentSeeder::class]);

    }
}
