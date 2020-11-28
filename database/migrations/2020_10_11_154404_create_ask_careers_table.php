<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAskCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_careers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('schedule');
            $table->integer('price');
            $table->unsignedInteger('mentor_id');
            $table->unsignedInteger('creator_id');
            $table->unsignedInteger('updater_id');
            $table->timestamps();
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
        Schema::dropIfExists('ask_careers');
    }
}
