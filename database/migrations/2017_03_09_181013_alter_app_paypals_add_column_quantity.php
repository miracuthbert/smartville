<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAppPaypalsAddColumnQuantity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_paypals', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('payment_plan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_paypals', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
