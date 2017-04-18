<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_property_id')->unsigned();
            $table->foreign('tenant_property_id')->references('id')->on('tenant_properties')->onDelete('cascade');
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('estate_properties')->onDelete('cascade');
            $table->integer('bill_id')->unsigned();
            $table->foreign('bill_id')->references('id')->on('estate_bills')->onDelete('cascade');
            $table->string('details')->nullable();
            $table->double('previous_usage')->default(0.00);
            $table->double('current_usage')->default(0.00);
            $table->double('unit_cost');
            $table->timestamp('date_from')->nullable();
            $table->timestamp('date_to')->nullable();
            $table->timestamp('date_due')->nullable();
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
        Schema::dropIfExists('tenant_bills');
    }
}
