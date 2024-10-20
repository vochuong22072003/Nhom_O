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
        Schema::create('post_catalogue_children', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_catalogue_parent_id')->unsigned();
            $table->foreign('post_catalogue_parent_id')->references('id')->on('post_catalogue_parent')->onDelete('cascade');
            $table->string('post_catalogue_children_name');
            $table->text('post_catalogue_children_description')->nullable();
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
        Schema::dropIfExists('post_catalogue_children');
    }
};
