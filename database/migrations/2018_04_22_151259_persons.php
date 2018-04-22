<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Persons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('starwarspersons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('height');
            $table->float('mass');
            $table->string('hair_color', 255);
            $table->string('skin_color', 255);
            $table->string('eye_color', 255);
            $table->string('birth_year', 255);
            $table->string('gender', 255);
            $table->string('homeworld', 255);
            $table->string('films', 255);
            $table->string('species', 255);
            $table->string('vehicles', 255);
            $table->string('starships', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
