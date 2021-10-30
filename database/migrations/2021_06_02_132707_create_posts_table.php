<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid' , 50)->unique();
            $table->string('title');
            $table->string('body');
            $table->enum('type' , ["Blog" , "Vlog"]);
            $table->string('tags')->nullable();
            $table->foreignId('author_id')->on("users")->nullable()->nullOnDelete()->index();
            $table->foreignId('category_id')->on("post_categories")->nullable()->nullOnDelete();
            $table->foreignId('cover_image')->on("files")->nullable()->nullOnDelete()->index();
            $table->foreignId('cover_video')->on("files")->nullable()->nullOnDelete()->index();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('access_level')->default("All");
            $table->tinyInteger('is_top_story')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_published')->default(0);
            $table->tinyInteger('can_comment')->default(1);
            $table->tinyInteger('is_sponsored')->default(0);
            $table->integer('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
