<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_rents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_property_id')->unsigned();
            $table->foreign('tenant_property_id')->references('id')->on('tenant_properties')->onDelete('cascade');
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('estate_properties')->onDelete('cascade');
            $table->string('details')->nullable();
            $table->float('amount');
            $table->date('date_from');
            $table->date('date_to');
            $table->date('date_due');
            $table->string('hash')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('tenant_rents');
    }
}
