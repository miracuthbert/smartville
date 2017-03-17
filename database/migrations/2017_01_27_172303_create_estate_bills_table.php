<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estate_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_app_id')->unsigned();
            $table->foreign('company_app_id')->references('id')->on('company_apps')->onDelete('cascade');
            $table->string('title');
            $table->string('summary');
            $table->text('description')->nullable();
            $table->integer('billing_interval')->default(1);
            $table->string('interval_type')->default(1);
            $table->double('billing_amount')->default(0);
            $table->boolean('properties')->default(0);
            $table->boolean('bill_plan')->default(0);
            $table->boolean('auto_billing')->default(0);
            $table->integer('billing_reminder')->default(1);
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
        Schema::dropIfExists('estate_bills');
    }
}
