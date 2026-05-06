<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('message');
            $table->boolean('is_read')->default(0);

            $table->unsignedBigInteger('created_by')->nullable();

            $table->string('notifiable_type')->nullable();
            $table->unsignedBigInteger('notifiable_id')->default(0);

            $table->index('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
