<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('title');
            $table->string('description',500);
            $table->text('content');
            $table->boolean('active');
            $table->dateTime('publish');

            $table->integer('sort');

            $table->integer('catalog_id')->unsigned();
            $table->foreign('catalog_id')->references('id')->on('catalog');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('gallery');
            $table->integer('price');
            $table->integer('rest');

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
        Schema::drop('products');
    }
}
