<?php

use Illuminate\Database\Seeder;

class EstatePropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '1', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 1', 'summary' => 'A 1 bedroom and half kitchen and bathroom apartment.', 'description' => 'A 1 bedroom and half kitchen and bathroom apartment.', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '0', 'tenants' => '1', 'status' => '0', 'created_at' => '2017-01-18 04:20:16', 'updated_at' => '2017-01-19 20:19:22', 'deleted_at' => '2017-01-19 20:19:22')
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '2', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 2', 'summary' => 'A 1 bedroom and half kitchen and bathroom apartment.', 'description' => '', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '1', 'tenants' => '1', 'status' => '1', 'created_at' => '2017-01-18 04:29:42', 'updated_at' => '2017-01-18 05:51:29', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '3', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 3', 'summary' => 'A 1 bedroom and half kitchen and bathroom apartment.', 'description' => '', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '0', 'tenants' => '1', 'status' => '1', 'created_at' => '2017-01-18 04:30:31', 'updated_at' => '2017-01-18 04:30:31', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '4', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 4', 'summary' => 'A 1 bedroom and half kitchen and bathroom apartment.', 'description' => '', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '1', 'tenants' => '1', 'status' => '1', 'created_at' => '2017-01-18 04:31:14', 'updated_at' => '2017-01-22 17:16:11', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '5', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 5', 'summary' => 'A 1 bedroom and half kitchen and bathroom apartment.', 'description' => '', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '1', 'tenants' => '1', 'status' => '0', 'created_at' => '2017-01-18 04:34:41', 'updated_at' => '2017-01-18 05:57:06', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '6', 'company_app_id' => '1', 'property_type' => '12', 'property_group' => NULL, 'title' => 'House 6', 'summary' => 'A 1 bedroom and half kitchen and bathroom apartment.', 'description' => '', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '0', 'tenants' => '1', 'status' => '0', 'created_at' => '2017-01-18 04:49:21', 'updated_at' => '2017-01-18 05:51:20', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '7', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 7', 'summary' => 'A 2 bedroom and half kitchen and bathroom apartment.', 'description' => '', 'size' => '1500.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '1', 'tenants' => '1', 'status' => '0', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-18 05:05:01', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '8', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 9', 'summary' => 'A cozy apartment.', 'description' => 'A cozy apartment.', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '0', 'tenants' => '1', 'status' => '0', 'created_at' => '2017-01-18 05:24:38', 'updated_at' => '2017-01-18 05:24:38', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '9', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => '2', 'title' => 'House 8', 'summary' => 'A cozy apartment.', 'description' => 'A cozy apartment.', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '0', 'tenants' => '1', 'status' => '1', 'created_at' => '2017-01-18 05:28:51', 'updated_at' => '2017-01-18 05:28:51', 'deleted_at' => NULL)
        );

        $estate_properties = \App\Models\v1\Estate\EstateProperty::create(
            array('id' => '10', 'company_app_id' => '1', 'property_type' => '8', 'property_group' => NULL, 'title' => 'House 10', 'summary' => 'A cozy apartment.', 'description' => 'A cozy apartment.', 'size' => '100.00', 'interval' => '1', 'location' => NULL, 'rentable' => '1', 'multiple_tenancy' => '0', 'tenants' => '1', 'status' => '0', 'created_at' => '2017-01-18 05:29:43', 'updated_at' => '2017-01-18 05:29:43', 'deleted_at' => NULL)
        );
    }
}
