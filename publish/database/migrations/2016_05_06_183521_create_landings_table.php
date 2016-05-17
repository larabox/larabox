<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');

            $table->string('title');
            $table->string('description');

            $table->string('alias');
            $table->string('image');

            $table->dateTime('publish');
            $table->dateTime('publish_end');

            $table->string('redirect');
            $table->boolean('active');

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
        Schema::table('landings', function(Blueprint $table)
        {
            Schema::drop('landing');
        });
    }
}
