<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tweet_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('content')->nullable();
            $table->integer('count_like')->nullable();
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

            $table->foreign('parent_id')
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
        Schema::dropIfExists('replies');
    }
}
