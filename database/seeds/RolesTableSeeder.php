<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Root
        $role = new \App\Role();
        $role->role = "Root";
        $role->alias = "site-root";
        $role->desc = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at blanditiis cum, dignissimos eius eveniet facilis ipsa libero magnam, natus nisi perferendis quasi quos rerum sapiente sunt suscipit! Nisi, quidem.";
        $role->summary  = "Controls the entire application.";
        $role->create = 1;
        $role->read = 1;
        $role->update = 1;
        $role->delete = 1;
        $role->status = 1;
        $role->tables = serialize(['users', 'roles', 'user_roles', 'activations', 'estates', 'groups', 'properties', 'tenants', 'leases']);
        $role->save();
//
//        //Admin
        $role = new \App\Role();
        $role->role = "Admin";
        $role->alias = "site-admin";
        $role->desc = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at blanditiis cum, dignissimos eius eveniet facilis ipsa libero magnam, natus nisi perferendis quasi quos rerum sapiente sunt suscipit! Nisi, quidem.";
        $role->summary = "Controls the entire application.";
        $role->create = 1;
        $role->read = 1;
        $role->update = 1;
        $role->delete = 1;
        $role->status = 1;
        $role->save();

//        //Estate Admin
        $role = new \App\Role();
        $role->role = "Company Admin";
        $role->alias = "company-app-admin";
        $role->desc = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at blanditiis cum, dignissimos eius eveniet facilis ipsa libero magnam, natus nisi perferendis quasi quos rerum sapiente sunt suscipit! Nisi, quidem.";
        $role->summary = "Controls their entire real estate application.";
        $role->create = 1;
        $role->read = 1;
        $role->update = 1;
        $role->delete = 1;
        $role->status = 1;
        $role->save();

        //Tenant
        $role = new \App\Role();
        $role->role = "Tenant";
        $role->alias = "estate-tenant";
        $role->desc = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at blanditiis cum, dignissimos eius eveniet facilis ipsa libero magnam, natus nisi perferendis quasi quos rerum sapiente sunt suscipit! Nisi, quidem.";
        $role->summary = "Gives user tenant roles.";
        $role->create = 1;
        $role->read = 1;
        $role->update = 1;
        $role->delete = 1;
        $role->status = 1;
        $role->save();
    }
}
