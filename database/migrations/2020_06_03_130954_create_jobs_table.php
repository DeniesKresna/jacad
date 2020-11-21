<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position')->nullable();
            $table->string('type')->nullable();
            $table->text('job_desc')->nullable();
            $table->string('work_time')->nullable();
            $table->string('dress_style')->nullable();
            $table->string('language')->nullable();
            $table->string('facility')->nullable();
            $table->string('salary')->nullable();
            $table->string('how_to_send')->nullable();
            $table->string('process_time')->nullable();
            $table->string('transfer_url')->nullable();
            $table->string('transfer_path')->nullable();
            $table->string('poster_url')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('jobhun_info')->nullable();
            $table->integer('view')->nullable();
            $table->smallInteger('read')->nullable();
            $table->smallInteger('verified')->default(0);
            $table->unsignedInteger('first_reader_id')->nullable();
            $table->timestamp('expired')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('verificator_id')->nullable();
            $table->unsignedInteger('creator_id')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
