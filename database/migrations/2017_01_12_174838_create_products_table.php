<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('monetization_id')->unsigned();
            $table->foreign('monetization_id')->references('id')->on('categories');
            $table->string('title');
            $table->text('summary');
            $table->text('desc');
            $table->boolean('app')->default(1);
            $table->text('icon')->nullable();
            $table->string('page')->nullable();
            $table->string('version_name')->nullable();
            $table->float('version_no')->nullable();
            $table->boolean('mode')->default(1);
            $table->boolean('coming_soon')->default(1);
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
        Schema::dropIfExists('products');
    }
}
