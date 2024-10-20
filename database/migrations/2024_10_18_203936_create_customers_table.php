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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cus_id'); // BIGINT(20), Primary Key, Auto Increment
            $table->string('cus_user', 255)->unique(); // NOT NULL, UNIQUE
            $table->string('cus_pass', 255); // NOT NULL
            $table->string('email', 100)->unique(); // NOT NULL, UNIQUE
            $table->timestamp('verify_at')->nullable(); // Nullable
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
