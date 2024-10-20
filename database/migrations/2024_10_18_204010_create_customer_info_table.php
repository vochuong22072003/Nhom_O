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
        Schema::create('customer_info', function (Blueprint $table) {
            $table->unsignedBigInteger('cus_id')->primary(); // BIGINT(20), Primary Key, Weak 
            $table->string('cus_name', 255); 
            $table->date('birth_date'); 
            $table->string('cus_phone', 20); 
            $table->string('address', 255); 
            $table->enum('gender', ['Male', 'Female', 'Other'])->default('Other'); 
            $table->string('cus_avt', 100)->nullable(); // Avatar (nullable)

            // Foreign Key
            $table->foreign('cus_id')->references('cus_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_info', function (Blueprint $table) {
            $table->dropForeign(['cus_id']);
        });
        Schema::dropIfExists('customer_info');
    }
};
