<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costdetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cost_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->integer('amount')->nullable();
            $table->string('memo_upload')->nullable();
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
        Schema::dropIfExists('costdetails');
    }
}
