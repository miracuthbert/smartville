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
//        $role = new \App\UserRole();
//        $role->user_id = 1;
//        $role->role_id = 1;
//        $role->status = 1;
//        $role->save();

        $role = \App\UserRole::create(
            array('user_id' => '1', 'role_id' => '1', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '1', 'role_id' => '3', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '1', 'role_id' => '4', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '2', 'role_id' => '4', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '3', 'role_id' => '4', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '4', 'role_id' => '4', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '2', 'role_id' => '3', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '1', 'role_id' => '3', 'status' => '1')
        );

        $role = \App\UserRole::create(
            array('user_id' => '1', 'role_id' => '3', 'status' => '1')
        );
    }
}
