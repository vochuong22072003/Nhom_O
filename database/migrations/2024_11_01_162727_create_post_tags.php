<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_tags', function (Blueprint $table) {
          
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->primary(['post_id', 'tag_id']);
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tag_id')->references('tag_id')->on('tags')->onDelete('cascade');

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::create('post_tags', function (Blueprint $table) {
            $table->dropForeign('post_id');
            $table->dropForeign('tag_id');

        });
        Schema::dropIfExists('post_tags');
    }
};
