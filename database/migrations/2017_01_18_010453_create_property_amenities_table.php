<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amenity_id')->unsigned();
            $table->foreign('amenity_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->integer('property_id')->unsigned();
            $table->foreign('property_id')->references('id')->on('estate_properties')->onDelete('cascade');
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
        Schema::dropIfExists('property_amenities');
    }
}
