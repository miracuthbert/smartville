<?php

use Illuminate\Database\Seeder;

class PropertyAmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '1', 'amenity_id' => '1', 'property_id' => '1', 'status' => '1', 'created_at' => '2017-01-18 04:20:16', 'updated_at' => '2017-01-18 04:20:16', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
        array('id' => '2', 'amenity_id' => '2', 'property_id' => '1', 'status' => '1', 'created_at' => '2017-01-18 04:20:16', 'updated_at' => '2017-01-18 04:20:16', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '3', 'amenity_id' => '1', 'property_id' => '2', 'status' => '1', 'created_at' => '2017-01-18 04:29:43', 'updated_at' => '2017-01-18 04:29:43', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '4', 'amenity_id' => '2', 'property_id' => '2', 'status' => '1', 'created_at' => '2017-01-18 04:29:43', 'updated_at' => '2017-01-18 04:29:43', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '5', 'amenity_id' => '1', 'property_id' => '3', 'status' => '1', 'created_at' => '2017-01-18 04:30:31', 'updated_at' => '2017-01-18 04:30:31', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '6', 'amenity_id' => '2', 'property_id' => '3', 'status' => '1', 'created_at' => '2017-01-18 04:30:31', 'updated_at' => '2017-01-18 04:30:31', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '7', 'amenity_id' => '1', 'property_id' => '4', 'status' => '1', 'created_at' => '2017-01-18 04:31:14', 'updated_at' => '2017-01-18 04:31:14', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '8', 'amenity_id' => '2', 'property_id' => '4', 'status' => '1', 'created_at' => '2017-01-18 04:31:14', 'updated_at' => '2017-01-18 04:31:14', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '9', 'amenity_id' => '1', 'property_id' => '5', 'status' => '1', 'created_at' => '2017-01-18 04:34:41', 'updated_at' => '2017-01-18 04:34:41', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '10', 'amenity_id' => '2', 'property_id' => '5', 'status' => '1', 'created_at' => '2017-01-18 04:34:41', 'updated_at' => '2017-01-18 04:34:41', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '11', 'amenity_id' => '1', 'property_id' => '6', 'status' => '0', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-19 19:22:58', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '12', 'amenity_id' => '2', 'property_id' => '6', 'status' => '1', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-19 19:22:58', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '13', 'amenity_id' => '1', 'property_id' => '7', 'status' => '1', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-18 05:05:01', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '14', 'amenity_id' => '2', 'property_id' => '7', 'status' => '1', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-18 05:05:01', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '15', 'amenity_id' => '1', 'property_id' => '8', 'status' => '1', 'created_at' => '2017-01-18 05:24:38', 'updated_at' => '2017-01-18 05:24:38', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '16', 'amenity_id' => '2', 'property_id' => '8', 'status' => '1', 'created_at' => '2017-01-18 05:24:38', 'updated_at' => '2017-01-18 05:24:38', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '17', 'amenity_id' => '1', 'property_id' => '9', 'status' => '1', 'created_at' => '2017-01-18 05:28:51', 'updated_at' => '2017-01-18 05:28:51', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '18', 'amenity_id' => '2', 'property_id' => '9', 'status' => '1', 'created_at' => '2017-01-18 05:28:51', 'updated_at' => '2017-01-18 05:28:51', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '19', 'amenity_id' => '1', 'property_id' => '10', 'status' => '1', 'created_at' => '2017-01-18 05:29:44', 'updated_at' => '2017-01-18 05:29:44', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '20', 'amenity_id' => '2', 'property_id' => '10', 'status' => '1', 'created_at' => '2017-01-18 05:29:44', 'updated_at' => '2017-01-18 05:29:44', 'deleted_at' => NULL)
        );

        $property_amenities = \App\PropertyAmenity::create(
            array('id' => '25', 'amenity_id' => '3', 'property_id' => '6', 'status' => '1', 'created_at' => '2017-01-19 10:31:33', 'updated_at' => '2017-01-19 13:01:38', 'deleted_at' => NULL)
        );

    }
}
