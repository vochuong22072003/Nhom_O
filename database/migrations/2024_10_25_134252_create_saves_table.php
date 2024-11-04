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
        Schema::create('saves', function (Blueprint $table) {
            $table->unsignedBigInteger('save_folder_id'); // Cột save_folder_id kiểu bigInt, làm khóa chính và khóa ngoại
            $table->unsignedBigInteger('post_id'); // Cột post_id kiểu bigInt, làm khóa chính và khóa ngoại
            $table->unsignedBigInteger('cus_id'); // Cột cus_id kiểu bigInt, làm khóa chính và khóa ngoại
            $table->timestamp('deleted_at')->nullable(); // Cột deleted_at kiểu timestamp, có thể null

            // Định nghĩa khóa chính cho cả ba cột
            $table->primary(['save_folder_id', 'post_id', 'cus_id']);

            // Định nghĩa khóa ngoại
            $table->foreign('save_folder_id')->references('folder_id')->on('save_folders')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('cus_id')->references('cus_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saves', function (Blueprint $table) {
            $table->dropForeign(['save_folder_id']);
            $table->dropForeign(['post_id']);
            $table->dropForeign(['cus_id']);
        });
        Schema::dropIfExists('saves');
    }
};
