<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//add thêm vài thư viện
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;


class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'Xem danh sách nhóm thành viên', 'canonical' => 'user.catalogue.index', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Thêm mới nhóm thành viên', 'canonical' => 'user.catalogue.store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sửa nhóm thành viên', 'canonical' => 'user.catalogue.edit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xóa nhóm thành viên', 'canonical' => 'user.catalogue.destroy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xem danh sách thành viên', 'canonical' => 'user.index', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Thêm mới thành viên', 'canonical' => 'user.store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sửa thành viên', 'canonical' => 'user.edit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xóa thành viên', 'canonical' => 'user.destroy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xem danh sách quyền', 'canonical' => 'permission.index', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Thêm mới quyền', 'canonical' => 'permission.store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sửa quyền', 'canonical' => 'permission.edit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xóa quyền', 'canonical' => 'permission.destroy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xem danh sách danh mục cha', 'canonical' => 'post.catalogue.parent.index', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xem danh sách danh mục con', 'canonical' => 'post.catalogue.children.index', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Thêm mới danh mục cha', 'canonical' => 'post.catalogue.parent.store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Thêm mới danh mục con', 'canonical' => 'post.catalogue.children.store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sửa danh mục cha', 'canonical' => 'post.catalogue.parent.edit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sửa danh mục con', 'canonical' => 'post.catalogue.children.edit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xóa danh mục cha', 'canonical' => 'post.catalogue.parent.destroy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xóa danh mục con', 'canonical' => 'post.catalogue.children.destroy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xem danh sách bài viết', 'canonical' => 'post.index', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Thêm mới bài viết', 'canonical' => 'post.store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sửa bài viết', 'canonical' => 'post.edit', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Xóa bài viết', 'canonical' => 'post.destroy', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
