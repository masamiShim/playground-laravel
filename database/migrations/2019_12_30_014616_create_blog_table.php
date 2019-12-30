<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->dateTime('posted_at')->nullable()->comment('投稿日時');
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
        Schema::dropIfExists('blogs');
    }
}
