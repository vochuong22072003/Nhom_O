<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class UserInfoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('user_info')->insert([
            [
                'user_catalogue_id' => 1,
                'user_id' => 1,
                'name' => 'Võ Tiến Chương',
                'phone' => '0123456789',
                'province_id' => '58',
                'district_id' => '585',
                'ward_id' => '22819',
                'address' => 'zxc123',
                'birthday' => '2003-07-22 00:00:00',
                'image' => '/userfiles/image/5-hoang-tu-dep-trai-va-quyen-ru-nhat-chau-au-khien-van-nguoi-me_20150708101828268.webp',
                'description' => 'Đây là tài khoản Quản trị viên',
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
            [
                'user_catalogue_id' => 2,
                'user_id' => 2,
                'name' => 'Nguyễn Hiếu Nghĩa',
                'phone' => '0333444555',
                'province_id' => '0',
                'district_id' => '0',
                'ward_id' => '0',
                'address' => NULL,
                'birthday' => '2000-05-27 00:00:00',
                'image' => NULL,
                'description' => NULL,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
            [
                'user_catalogue_id' => 3,
                'user_id' => 3,
                'name' => 'Tác Giả 01',
                'phone' => '0159357456',
                'province_id' => '35',
                'district_id' => '352',
                'ward_id' => '13540',
                'address' => 'fgh456',
                'birthday' => '2004-06-14 00:00:00',
                'image' => '/userfiles/image/user/5-hoang-tu-dep-trai-va-quyen-ru-nhat-chau-au-khien-van-nguoi-me_20150708101836037.webp',
                'description' => NULL,
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now(), 
            ],
        ]);
    }
}
