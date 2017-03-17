<?php

use Illuminate\Database\Seeder;

class CompanyAppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $company_apps = \App\CompanyApp::create(
            array('id' => '1', 'product_id' => '1', 'company_id' => '1', 'status' => '1', 'created_at' => '2017-01-16 02:41:13', 'updated_at' => '2017-01-16 19:46:17', 'deleted_at' => NULL)
        );

        $company_apps = \App\CompanyApp::create(
            array('id' => '2', 'product_id' => '1', 'company_id' => '2', 'status' => '1', 'created_at' => '2017-02-15 18:15:20', 'updated_at' => '2017-02-15 18:15:20', 'deleted_at' => NULL)
        );

        $company_apps = \App\CompanyApp::create(
            array('id' => '3', 'product_id' => '1', 'company_id' => '3', 'status' => '1', 'created_at' => '2017-02-15 18:33:02', 'updated_at' => '2017-02-15 18:33:02', 'deleted_at' => NULL)
        );

        $company_apps = \App\CompanyApp::create(
            array('id' => '4', 'product_id' => '1', 'company_id' => '4', 'status' => '0', 'created_at' => '2017-02-15 18:37:17', 'updated_at' => '2017-02-16 16:36:32', 'deleted_at' => '2017-02-16 16:36:31')
        );
    }
}
