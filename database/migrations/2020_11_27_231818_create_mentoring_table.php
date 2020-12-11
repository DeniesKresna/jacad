<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentoring', function (Blueprint $table) {
            $table->increments('id');
            $table->text('spesific_topic');
            $table->string('date');
            $table->string('time');
            $table->string('duration');
            $table->string('jobhun_info');
            $table->unsignedInteger('ask_career_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('updater_id');
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
        Schema::dropIfExists('mentoring');
    }
}
