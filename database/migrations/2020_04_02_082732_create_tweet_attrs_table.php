<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_attrs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tweet_id')->nullable();
            $table->unsignedBigInteger('reply_id')->nullable();
            $table->integer('type')->nullable();
            $table->longText('data')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->cascadeOnDelete();

            $table->foreign('tweet_id')
                ->references('id')
                ->on('tweets')
                ->onUpdate('cascade')
                ->cascadeOnDelete();

            $table->foreign('reply_id')
                ->references('id')
                ->on('replies')
                ->onUpdate('cascade')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweet_attrs');
    }
}
