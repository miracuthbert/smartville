<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\UserRole();
        $role->user_id = 1;
        $role->role_id = 1;
        $role->status = 1;
        $role->save();

        $role = \App\UserRole::create(
            array('id' => '3', 'user_id' => '1', 'role_id' => '3', 'status' => '1', 'created_at' => '2017-01-16 02:05:36', 'updated_at' => '2017-01-16 02:05:36', 'deleted_at' => NULL)
        );

        $role = \App\UserRole::create(
            array('id' => '7', 'user_id' => '1', 'role_id' => '4', 'status' => '1', 'created_at' => '2017-01-21 13:17:16', 'updated_at' => '2017-01-21 13:17:16', 'deleted_at' => NULL)
        );

        $role = \App\UserRole::create(
            array('id' => '8', 'user_id' => '2', 'role_id' => '4', 'status' => '1', 'created_at' => '2017-01-22 16:25:27', 'updated_at' => '2017-01-22 16:25:27', 'deleted_at' => NULL)
        );

        $role = \App\UserRole::create(
            array('id' => '9', 'user_id' => '3', 'role_id' => '4', 'status' => '1', 'created_at' => '2017-01-22 16:59:05', 'updated_at' => '2017-01-22 16:59:05', 'deleted_at' => NULL)
        );

        $role = \App\UserRole::create(
            array('id' => '10', 'user_id' => '4', 'role_id' => '4', 'status' => '1', 'created_at' => '2017-01-22 17:16:11', 'updated_at' => '2017-01-22 17:16:11', 'deleted_at' => NULL)
        );

        $role = \App\UserRole::create(
            array('id' => '11', 'user_id' => '2', 'role_id' => '3', 'status' => '1', 'created_at' => '2017-02-15 18:15:20', 'updated_at' => '2017-02-15 18:15:20', 'deleted_at' => NULL)
        );

        $role = \App\UserRole::create(
            array('id' => '12', 'user_id' => '1', 'role_id' => '3', 'status' => '1', 'created_at' => '2017-02-15 18:33:02', 'updated_at' => '2017-02-15 18:33:02', 'deleted_at' => NULL)
        );

        $role = \App\UserRole::create(
            array('id' => '13', 'user_id' => '1', 'role_id' => '3', 'status' => '1', 'created_at' => '2017-02-15 18:37:17', 'updated_at' => '2017-02-15 18:37:17', 'deleted_at' => NULL)
        );
    }
}
