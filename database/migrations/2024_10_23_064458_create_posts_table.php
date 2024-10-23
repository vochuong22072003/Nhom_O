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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_catalogue_children_id')->unsigned();
            $table->foreign('post_catalogue_children_id')->references('id')->on('post_catalogue_children')->onDelete('cascade');
            $table->bigInteger('post_catalogue_parent_id')->unsigned();
            $table->foreign('post_catalogue_parent_id')->references('id')->on('post_catalogue_parent')->onDelete('cascade');
            $table->string('post_name');
            $table->string('post_excerpt')->nullable();
            $table->longText('post_content')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('publish')->default(2);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
