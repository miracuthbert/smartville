<?php

use Illuminate\Database\Seeder;

class CompanyUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company_users = \App\Models\v1\Company\CompanyUser::create(
            array('id' => '1', 'user_id' => '1', 'company_app_id' => '1', 'admin' => '1', 'status' => '1', 'created_at' => '2017-01-16 02:41:14', 'updated_at' => '2017-01-16 02:41:14', 'deleted_at' => NULL)
        );

        $company_users = \App\Models\v1\Company\CompanyUser::create(
            array('id' => '2', 'user_id' => '2', 'company_app_id' => '2', 'admin' => '1', 'status' => '1', 'created_at' => '2017-02-15 18:15:20', 'updated_at' => '2017-02-15 18:15:20', 'deleted_at' => NULL)
        );

        $company_users = \App\Models\v1\Company\CompanyUser::create(
            array('id' => '3', 'user_id' => '1', 'company_app_id' => '3', 'admin' => '1', 'status' => '1', 'created_at' => '2017-02-15 18:33:02', 'updated_at' => '2017-02-15 18:33:02', 'deleted_at' => NULL)
        );

        $company_users = \App\Models\v1\Company\CompanyUser::create(
            array('id' => '4', 'user_id' => '1', 'company_app_id' => '4', 'admin' => '1', 'status' => '1', 'created_at' => '2017-02-15 18:37:17', 'updated_at' => '2017-02-15 18:37:17', 'deleted_at' => NULL)
        );

    }
}
