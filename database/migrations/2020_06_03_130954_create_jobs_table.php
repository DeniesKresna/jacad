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
            $table->string('position');
            $table->string('type');
            $table->text('job_desc');
            $table->string('work_time');
            $table->string('dress_style');
            $table->string('language');
            $table->string('facility');
            $table->string('salary');
            $table->string('how_to_send');
            $table->string('process_time');
            $table->string('transfer_url');
            $table->string('transfer_path');
            $table->string('poster_url');
            $table->string('poster_path');
            $table->string('jobhun_info');
            $table->integer('view');
            $table->smallInteger('read');
            $table->smallInteger('verified');
            $table->unsignedInteger('first_reader_id');
            $table->timestamp('expired');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('verificator_id');
            $table->unsignedInteger('creator_id');
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
