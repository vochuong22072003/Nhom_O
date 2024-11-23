<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class UserCatalogueSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('user_catalogues')->insert([
            [
                'name' => 'Quản trị viên',
            ],
            [
                'name' => 'Cộng tác viên',
            ],
            [
                'name' => 'Tác giả',
            ]
        ]);
    }
}
