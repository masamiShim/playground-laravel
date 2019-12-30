<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id')->comment('投稿ID');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->text('body')->comment('本文');
            $table->unsignedBigInteger('posted_by')->comment('投稿者');
            $table->dateTime('posted_at')->comment('投稿日時');
            $table->unsignedBigInteger('created_by');
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('updated_by');
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('comments');
    }
}
