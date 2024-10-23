<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToPostCatalogueParentIdInPostCatalogueChildrenTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('post_catalogue_children', function (Blueprint $table) {
            // Thêm giá trị mặc định cho cột 'post_catalogue_parent_id'
            $table->unsignedBigInteger('post_catalogue_parent_id')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_catalogue_children', function (Blueprint $table) {
            // Xóa giá trị mặc định
            $table->unsignedBigInteger('post_catalogue_parent_id')->default(null)->cphphange();
        });
    }
}
