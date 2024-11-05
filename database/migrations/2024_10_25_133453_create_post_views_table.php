<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_views', function (Blueprint $table) {
            $table->id('post_view_id'); // Tạo cột post_view_id kiểu bigInt, auto increment, primary key
            $table->unsignedBigInteger('post_id'); // Cột post_id kiểu bigInt, not null
            $table->unsignedBigInteger('view_count')->default(0); // Cột view_count kiểu bigInt, default 0
            $table->timestamp('deleted_at')->nullable(); // Cột deleted_at kiểu timestamp, có thể null
            $table->timestamps(); // Tạo các cột created_at và updated_at kiểu timestamp, có thể null

            // Định nghĩa khóa ngoại
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_views', function (Blueprint $table) {
            if (Schema::hasColumn('post_views', 'post_id')) {
                $table->dropForeign(['post_id']);
            }
        });
       
        Schema::dropIfExists('post_views');
    }
};
