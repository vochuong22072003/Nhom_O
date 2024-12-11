<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'vochuong57@gmail.com',
                'password' => Hash::make('123456'),
                'user_catalogue_id' => '1'
            ],
            [
                'email' => 'nguyenhieu@gmail.com',
                'password' => Hash::make('123456'),
                'user_catalogue_id' => '2'
            ],
            [
                'email' => 'tacgia01@gmail.com',
                'password' => Hash::make('123456'),
                'user_catalogue_id' => '3'
            ],
            [
                'email' => 'vochuong577@gmail.com',
                'password' => Hash::make('123456'),
                'user_catalogue_id' => '2'
            ]
        ]);
    }
}
