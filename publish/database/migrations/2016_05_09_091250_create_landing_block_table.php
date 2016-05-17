<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_blocks', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('landing_id');

            $table->string('name');

            $table->string('label');
            $table->string('description');

            $table->string('class');

            $table->longText('content');

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
        Schema::table('landing_blocks', function(Blueprint $table)
        {
            Schema::drop('landing_blocks');
        });
    }
}
