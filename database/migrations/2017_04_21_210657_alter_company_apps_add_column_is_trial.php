<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyAppsAddColumnIsTrial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_apps', function (Blueprint $table) {
            $table->boolean('is_trial')->after('deleted_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_apps', function (Blueprint $table) {
            $table->dropColumn('is_trial');
        });
    }
}
