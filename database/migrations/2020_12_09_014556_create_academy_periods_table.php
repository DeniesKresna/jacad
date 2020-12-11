<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademyPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('period');
            $table->integer('price');
            $table->text('description');
            $table->smallInteger('active');
            $table->unsignedInteger('academy_id');
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
        Schema::dropIfExists('academy_periods');
    }
}
