<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_app_id')->unsigned();
            $table->foreign('company_app_id')->references('id')->on('company_apps')->onDelete('cascade');
            $table->integer('property_type')->unsigned()->nullable();
            $table->foreign('property_type')->references('id')->on('categories');
            $table->integer('property_group')->unsigned()->nullable();
            $table->foreign('property_group')->references('id')->on('estate_groups')->onDelete('set null');
            $table->string('title');
            $table->string('summary');
            $table->text('description')->nullable();
            $table->float('size');
            $table->integer('interval')->nullable();
            $table->string('location')->nullable();
            $table->boolean('rentable')->default(1);
            $table->boolean('multiple_tenancy')->default(0);
            $table->integer('tenants')->default(1);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('estate_properties');
    }
}
