<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_subscriptions_paypal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_app_id')->unsigned();
            $table->foreign('company_app_id')->references('id')->on('company_apps')->onDelete('no action');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('payment_id');
            $table->integer('plan_id')->unsigned();
            $table->string('payment_hash');
            $table->boolean('completed')->default(0);
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_paypals');
    }
}
