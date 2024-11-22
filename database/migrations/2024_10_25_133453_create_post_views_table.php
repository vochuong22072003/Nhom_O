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
            $table->id('post_view_id'); 
            $table->unsignedBigInteger('post_id'); 
            $table->unsignedBigInteger('view_count')->default(0); 
            $table->timestamp('deleted_at')->nullable(); 
            $table->timestamps(); 
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
