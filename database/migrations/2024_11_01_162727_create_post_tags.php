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
            $table->id('post_tag_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tag_id')->references('tag_id')->on('tags')->onDelete('cascade');

            $table->unique(['post_id', 'tag_id']); // Đảm bảo mỗi bài viết chỉ có một tag duy nhất
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
