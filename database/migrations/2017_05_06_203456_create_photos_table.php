<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audience_id')->unsigned()->nullable();
            $table->foreign('audience_id')->references('id')->on('categories');
            $table->nullableMorphs('photoable');
            $table->string('caption');
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->text('image');
            $table->text('thumbnail');
            $table->text('data')->nullable();
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
        Schema::dropIfExists('photos');
    }
}
