<?php

use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tenants = \App\Tenant::create(
            array('id' => '3', 'user_id' => '1', 'company_app_id' => '1', 'status' => '1', 'created_at' => '2017-01-21 13:17:16', 'updated_at' => '2017-01-21 18:14:45', 'deleted_at' => NULL)
        );

        $tenants = \App\Tenant::create(
            array('id' => '4', 'user_id' => '2', 'company_app_id' => '1', 'status' => '1', 'created_at' => '2017-01-22 16:25:27', 'updated_at' => '2017-01-22 16:25:27', 'deleted_at' => NULL)
        );

        $tenants = \App\Tenant::create(
            array('id' => '5', 'user_id' => '3', 'company_app_id' => '1', 'status' => '1', 'created_at' => '2017-01-22 16:59:05', 'updated_at' => '2017-01-22 16:59:05', 'deleted_at' => NULL)
        );

        $tenants = \App\Tenant::create(
            array('id' => '6', 'user_id' => '4', 'company_app_id' => '1', 'status' => '1', 'created_at' => '2017-01-22 17:16:11', 'updated_at' => '2017-01-22 17:16:11', 'deleted_at' => NULL)
        );

    }
}
