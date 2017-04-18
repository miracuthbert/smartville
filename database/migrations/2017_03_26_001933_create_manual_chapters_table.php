<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('manual_id')->unsigned();
            $table->foreign('manual_id')->references('id')->on('manuals')->onDelete('cascade');
            $table->nullableMorphs('featureable');
//            $table->integer('feature_id')->unsigned()->nullable();
//            $table->foreign('feature_id')->references('id')->on('product_features')->onDelete('cascade');
            $table->string('title')->unique();
            $table->text('body');
            $table->string('url')->unique();
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
        Schema::dropIfExists('manual_chapters');
    }
}
