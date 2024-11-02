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
        Schema::create('save_folders', function (Blueprint $table) {
            $table->id('folder_id'); // Tạo cột folder_id kiểu bigInt, auto increment, primary key
            $table->string('folder_name', 20); // Cột folder_name kiểu nvarchar(20), not null
            $table->string('description', 200)->nullable(); // Cột description kiểu nvarchar(200), có thể null
            $table->unsignedBigInteger('cus_owned'); // Cột cus_owned kiểu bigInt, not null
            $table->timestamp('created_at')->nullable(); // Cột created_at kiểu timestamp, có thể null
            $table->timestamp('deleted_at')->nullable(); // Cột deleted_at kiểu timestamp, có thể null
            $table->foreign('cus_owned')->references('cus_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('save_folders', function (Blueprint $table) {
            $table->dropForeign(['cus_owned']);
        });
        Schema::dropIfExists('save_folders'); 
    }
};
