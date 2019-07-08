<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title',100);
            $table->string('slug',150);
            $table->string('sapo',180);//description
            $table->integer('categories_id')->unsigned();//categories_id
            $table->string('avatar',120);//thumbnail
            $table->tinyInteger('status')->default(1);
            $table->dateTime('publish_date')->nullable();
            $table->tinyInteger('lang_id')->default(1);

            $table->timestamps();
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
