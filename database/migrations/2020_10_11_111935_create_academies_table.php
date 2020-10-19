<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('rating');
            $table->string('review');
            $table->integer('price');
            $table->string('faq');
            $table->string('learning_resources');
            $table->string('learning_process');
            $table->string('starting_time');
            $table->string('platform');
            $table->integer('mentor_id');
            $table->integer('creator_id');
            $table->integer('updater_id');
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
        Schema::dropIfExists('academies');
    }
}
