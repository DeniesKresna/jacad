<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service');
            $table->text('content');
            $table->unsignedInteger('creator_id');
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
        Schema::dropIfExists('opening');
    }
}
