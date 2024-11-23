<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class CommentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'test bl',
                'parent_id' => '0',
                'created_at' => '2024-11-14 23:19:37',
                'updated_at' => '2024-11-14 23:19:37',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'zxc',
                'parent_id' => '0',
                'created_at' => '2024-11-14 23:26:48',
                'updated_at' => '2024-11-14 23:26:48',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'Bài viết rất hay!',
                'parent_id' => '0',
                'created_at' => '2024-11-15 00:03:01',
                'updated_at' => '2024-11-15 00:03:01',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'g1',
                'parent_id' => '1',
                'created_at' => '2024-11-15 00:41:22',
                'updated_at' => '2024-11-15 00:41:22',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'g2',
                'parent_id' => '1',
                'created_at' => '2024-11-16 23:17:06',
                'updated_at' => '2024-11-16 23:17:06',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'g3',
                'parent_id' => '1',
                'created_at' => '2024-11-16 23:39:18',
                'updated_at' => '2024-11-16 23:39:18',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'g4',
                'parent_id' => '1',
                'created_at' => '2024-11-16 23:44:56',
                'updated_at' => '2024-11-16 23:44:56',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'g5',
                'parent_id' => '1',
                'created_at' => '2024-11-17 00:13:21',
                'updated_at' => '2024-11-17 00:13:21',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'g6',
                'parent_id' => '1',
                'created_at' => '2024-11-17 00:14:27',
                'updated_at' => '2024-11-17 00:14:27',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'a1',
                'parent_id' => '2',
                'created_at' => '2024-11-17 00:17:46',
                'updated_at' => '2024-11-17 00:17:46',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'a2',
                'parent_id' => '2',
                'created_at' => '2024-11-17 00:17:46',
                'updated_at' => '2024-11-17 00:17:46',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'z1',
                'parent_id' => '3',
                'created_at' => '2024-11-17 03:48:10',
                'updated_at' => '2024-11-17 03:48:10',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'z2',
                'parent_id' => '3',
                'created_at' => '2024-11-17 04:56:40',
                'updated_at' => '2024-11-17 04:56:40',
            ],
            [
                'customer_id' => '2',
                'post_id' => '2',
                'content' => 'tl g4',
                'parent_id' => '7',
                'created_at' => '2024-11-17 04:56:50',
                'updated_at' => '2024-11-17 04:56:50',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'tl g2',
                'parent_id' => '5',
                'created_at' => '2024-11-17 08:08:23',
                'updated_at' => '2024-11-17 08:08:23',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'tl z2',
                'parent_id' => '13',
                'created_at' => '2024-11-17 19:08:10',
                'updated_at' => '2024-11-17 19:08:10',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'tl a2',
                'parent_id' => '11',
                'created_at' => '2024-11-17 19:10:07',
                'updated_at' => '2024-11-17 19:10:07',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'tl cua tl z2',
                'parent_id' => '16',
                'created_at' => '2024-11-17 19:12:37',
                'updated_at' => '2024-11-17 19:12:37',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'bình luận mới',
                'parent_id' => '0',
                'created_at' => '2024-11-17 20:46:11',
                'updated_at' => '2024-11-17 20:46:11',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => '135',
                'parent_id' => '1',
                'created_at' => '2024-11-18 03:09:00',
                'updated_at' => '2024-11-18 03:09:00',
            ],
            [
                'customer_id' => '1',
                'post_id' => '2',
                'content' => 'zzzzzzzzzzz',
                'parent_id' => '3',
                'created_at' => '2024-11-19 19:27:10',
                'updated_at' => '2024-11-19 19:27:10',
            ],
        ]);
    }
}
