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
            $table->id('folder_id'); 
            $table->string('folder_name', 20); 
            $table->string('description', 200)->nullable(); 
            $table->unsignedBigInteger('cus_owned'); 
            $table->timestamp('created_at')->nullable(); 
            $table->timestamp('deleted_at')->nullable(); 
            $table->timestamp('updated_at')->nullable();
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
