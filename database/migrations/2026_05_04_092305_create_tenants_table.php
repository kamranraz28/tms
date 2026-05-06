<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone',14)->unique()->nullable();
            $table->string('address');
            $table->string('nid_number',17)->nullable();
            $table->string('nid_upload')->nullable();
            $table->integer('status')->default(1);
            $table->integer('invoicing')->default(1)->comment('1-Automatic, 2-Manual');
            $table->integer('invoice_month')->default(1)->comment('1-current, 0-previous');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
