<?php

use Illuminate\Database\Seeder;

class TenantPropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant_properties = \App\Models\v1\Tenant\TenantProperty::create(
            array('id' => '1', 'tenant_id' => '3', 'property_id' => '2', 'lease_duration' => '27', 'move_in' => '2015-05-16', 'move_out' => NULL, 'status' => '1', 'created_at' => '2017-01-21 13:17:16', 'updated_at' => '2017-01-22 16:24:19', 'deleted_at' => NULL)
        );

        $tenant_properties = \App\Models\v1\Tenant\TenantProperty::create(
            array('id' => '2', 'tenant_id' => '4', 'property_id' => '3', 'lease_duration' => '12', 'move_in' => '2017-01-25', 'move_out' => NULL, 'status' => '1', 'created_at' => '2017-01-22 16:25:27', 'updated_at' => '2017-01-22 16:25:27', 'deleted_at' => NULL)
        );

        $tenant_properties = \App\Models\v1\Tenant\TenantProperty::create(
            array('id' => '3', 'tenant_id' => '5', 'property_id' => '9', 'lease_duration' => '12', 'move_in' => '2017-02-01', 'move_out' => NULL, 'status' => '1', 'created_at' => '2017-01-22 16:59:05', 'updated_at' => '2017-01-22 16:59:05', 'deleted_at' => NULL)
        );

        $tenant_properties = \App\Models\v1\Tenant\TenantProperty::create(
            array('id' => '4', 'tenant_id' => '6', 'property_id' => '4', 'lease_duration' => '18', 'move_in' => '2017-01-26', 'move_out' => NULL, 'status' => '1', 'created_at' => '2017-01-22 17:16:11', 'updated_at' => '2017-01-22 17:16:11', 'deleted_at' => NULL)
        );

    }
}
