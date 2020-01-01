<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('post_id')->comment('投稿ID');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->unsignedInteger('user_id')->comment('ユーザID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_favorite')->comment('お気に入りかどうか');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_favorites');
    }
}
