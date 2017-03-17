<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductPlansAddDurationColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_plans', function (Blueprint $table) {
            $table->integer('duration')->after('trial_days')->default(1);
            $table->string('duration_type')->after('duration')->default('month');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_plans', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('duration_type');
        });
    }
}
