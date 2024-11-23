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
        Schema::create('likes', function (Blueprint $table) {
            $table->id('likes_id'); // Tạo cột likes_id kiểu bigInt, auto increment, primary key
            $table->unsignedBigInteger('post_id'); // Cột post_id kiểu bigInt, not null
            $table->unsignedBigInteger('cus_id'); // Cột cus_id kiểu bigInt, not null
            $table->timestamp('deleted_at')->nullable(); // Cột deleted_at kiểu timestamp, có thể null
            $table->timestamps(); // Tạo các cột created_at và updated_at kiểu timestamp

            // Định nghĩa khóa ngoại
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('cus_id')->references('cus_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            if (Schema::hasColumn('likes', 'cus_id')) {
      
                $table->dropForeign(['cus_id']);
            }
            if (Schema::hasColumn('likes', 'post_id')) {
      
                $table->dropForeign(['post_id']);
            }
        });
       
        Schema::dropIfExists('likes'); 
    }
};
