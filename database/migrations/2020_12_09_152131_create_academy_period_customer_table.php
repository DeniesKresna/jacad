<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademyPeriodCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academy_period_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->text('description');
            $table->smallInteger('status');
            $table->unsignedInteger('academy_period_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('payment_id');
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
        Schema::dropIfExists('academy_period_customer');
    }
}
