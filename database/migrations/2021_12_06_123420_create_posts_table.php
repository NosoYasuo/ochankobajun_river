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
            $table->string('title');
            $table->text('message');
            $table->text('file_name')->nullable();
            $table->text('y_id')->nullable();
            $table->bigInteger('file_ext')->nullable();
            $table->bigInteger('river_id');
            $table->string('address', 100)->nullable();
            $table->float('latitude', 9, 6)->nullable();
            $table->float('longitude', 9, 6)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_name');
            $table->bigInteger('caution')->nullable();
            $table->bigInteger('type')->nullable();  //0 投稿 1行政 2企業
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
