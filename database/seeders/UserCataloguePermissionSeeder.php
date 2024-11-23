<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class UserCataloguePermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('user_catalogue_permission')->insert([
            ['user_catalogue_id' => 1, 'permission_id' => 5],
            ['user_catalogue_id' => 1, 'permission_id' => 1],
            ['user_catalogue_id' => 1, 'permission_id' => 2],
            ['user_catalogue_id' => 1, 'permission_id' => 3],
            ['user_catalogue_id' => 1, 'permission_id' => 4],
            ['user_catalogue_id' => 1, 'permission_id' => 6],
            ['user_catalogue_id' => 1, 'permission_id' => 7],
            ['user_catalogue_id' => 1, 'permission_id' => 8],
            ['user_catalogue_id' => 1, 'permission_id' => 9],
            ['user_catalogue_id' => 1, 'permission_id' => 10],
            ['user_catalogue_id' => 1, 'permission_id' => 11],
            ['user_catalogue_id' => 1, 'permission_id' => 12],
            ['user_catalogue_id' => 2, 'permission_id' => 5],
            ['user_catalogue_id' => 2, 'permission_id' => 6],
            ['user_catalogue_id' => 2, 'permission_id' => 7],
            ['user_catalogue_id' => 2, 'permission_id' => 8],
            ['user_catalogue_id' => 1, 'permission_id' => 14],
            ['user_catalogue_id' => 1, 'permission_id' => 15],
            ['user_catalogue_id' => 1, 'permission_id' => 16],
            ['user_catalogue_id' => 1, 'permission_id' => 17],
            ['user_catalogue_id' => 1, 'permission_id' => 18],
            ['user_catalogue_id' => 1, 'permission_id' => 19],
            ['user_catalogue_id' => 1, 'permission_id' => 20],
            ['user_catalogue_id' => 1, 'permission_id' => 13],
            ['user_catalogue_id' => 1, 'permission_id' => 21],
            ['user_catalogue_id' => 1, 'permission_id' => 22],
            ['user_catalogue_id' => 1, 'permission_id' => 23],
            ['user_catalogue_id' => 1, 'permission_id' => 24],
            ['user_catalogue_id' => 2, 'permission_id' => 13],
            ['user_catalogue_id' => 2, 'permission_id' => 14],
            ['user_catalogue_id' => 2, 'permission_id' => 21],
            ['user_catalogue_id' => 2, 'permission_id' => 22],
            ['user_catalogue_id' => 2, 'permission_id' => 23],
            ['user_catalogue_id' => 2, 'permission_id' => 24],
        ]);
    }
}
