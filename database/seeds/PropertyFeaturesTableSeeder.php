<?php

use Illuminate\Database\Seeder;

class PropertyFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '1', 'property_id' => '1', 'title' => 'A bedroom', 'details' => 'Bedroom with wardrobe', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:20:16', 'updated_at' => '2017-01-19 12:21:53', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '2', 'property_id' => '1', 'title' => 'Fully Furnished kitchen', 'details' => 'Mini Kitchen', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:20:17', 'updated_at' => '2017-01-19 12:21:53', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '3', 'property_id' => '1', 'title' => '1 and a half bathroom', 'details' => 'Bathroom with toilet', 'total_no' => '1.5', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:20:17', 'updated_at' => '2017-01-19 12:21:53', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '4', 'property_id' => '2', 'title' => 'Bedroom', 'details' => 'A bedroom', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:29:43', 'updated_at' => '2017-01-19 13:40:04', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '5', 'property_id' => '2', 'title' => 'Fully Furnished kitchen', 'details' => 'Partly Furnished kitchen', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:29:43', 'updated_at' => '2017-01-19 12:22:30', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '6', 'property_id' => '2', 'title' => '1 and a half bathroom', 'details' => 'Two and a half bathroom', 'total_no' => '1.5', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:29:43', 'updated_at' => '2017-01-19 12:22:30', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '7', 'property_id' => '3', 'title' => 'Bedroom', 'details' => 'A bedroom', 'total_no' => '3', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:30:31', 'updated_at' => '2017-01-19 13:40:04', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '8', 'property_id' => '3', 'title' => 'Fully Furnished kitchen', 'details' => 'Partly Furnished kitchen', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:30:31', 'updated_at' => '2017-01-19 12:28:35', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '9', 'property_id' => '3', 'title' => '1 and a half bathroom', 'details' => 'Two and a half bathroom', 'total_no' => '1.5', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:30:31', 'updated_at' => '2017-01-19 12:28:35', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '10', 'property_id' => '4', 'title' => 'Bedroom', 'details' => 'A bedroom', 'total_no' => '2', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:31:14', 'updated_at' => '2017-01-19 13:40:04', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '11', 'property_id' => '4', 'title' => 'Fully Furnished kitchen', 'details' => 'Partly Furnished kitchen', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:31:15', 'updated_at' => '2017-01-19 12:30:48', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '12', 'property_id' => '4', 'title' => '1 and a half bathroom', 'details' => 'Two and a half bathroom', 'total_no' => '1.5', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:31:15', 'updated_at' => '2017-01-19 12:30:48', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '13', 'property_id' => '5', 'title' => 'Bedroom', 'details' => 'A bedroom', 'total_no' => '2', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:34:41', 'updated_at' => '2017-01-19 13:40:04', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '14', 'property_id' => '5', 'title' => 'Fully Furnished kitchen', 'details' => 'Partly Furnished kitchen', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:34:41', 'updated_at' => '2017-01-19 12:31:39', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '15', 'property_id' => '5', 'title' => '1 and a half bathroom', 'details' => 'Two and a half bathroom', 'total_no' => '1.5', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:34:41', 'updated_at' => '2017-01-19 12:31:39', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '16', 'property_id' => '6', 'title' => 'Bedroom', 'details' => 'A bedroom with a small wardrobe.', 'total_no' => '2', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-19 17:51:18', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '17', 'property_id' => '6', 'title' => 'Kitchen', 'details' => 'No furnishings provided.', 'total_no' => '1/2', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-19 18:59:44', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '18', 'property_id' => '6', 'title' => 'Bathroom', 'details' => 'One and a half bathroom.', 'total_no' => '11/2', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-19 19:00:15', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '19', 'property_id' => '6', 'title' => 'Living room', 'details' => 'Partially furnished living room.', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-19 17:56:04', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '20', 'property_id' => '6', 'title' => 'Dining room', 'details' => 'No furnishing', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-19 12:22:31', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '21', 'property_id' => '7', 'title' => 'Bedroom', 'details' => 'A bedroom', 'total_no' => '2', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-19 13:40:04', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '22', 'property_id' => '7', 'title' => 'Kitchen', 'details' => 'Fully Furnished kitchen', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-18 05:05:01', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '23', 'property_id' => '7', 'title' => 'Bathroom', 'details' => '1 and a half bathroom', 'total_no' => '1.5', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-18 05:05:01', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '24', 'property_id' => '7', 'title' => 'Living room', 'details' => 'Partially furnished living room', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-18 05:05:01', 'deleted_at' => NULL)
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '27', 'property_id' => '6', 'title' => 'Test 1', 'details' => 'Test Feature 1', 'total_no' => '', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-19 13:44:13', 'updated_at' => '2017-01-19 13:46:12', 'deleted_at' => '2017-01-19 13:46:12')
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '28', 'property_id' => '6', 'title' => 'Test', 'details' => 'just a test feature', 'total_no' => '2', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-19 15:11:48', 'updated_at' => '2017-01-19 15:15:02', 'deleted_at' => '2017-01-19 15:15:02')
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '29', 'property_id' => '6', 'title' => 'Test', 'details' => 'Test feature', 'total_no' => '1', 'size' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-19 15:18:23', 'updated_at' => '2017-01-19 17:09:37', 'deleted_at' => '2017-01-19 17:09:37')
        );

        $property_features = \App\Models\v1\Property\PropertyFeature::create(
            array('id' => '30', 'property_id' => '6', 'title' => 'Another test', 'details' => 'another test feature', 'total_no' => '2', 'size' => NULL, 'unit' => NULL, 'status' => '0', 'created_at' => '2017-01-19 15:18:23', 'updated_at' => '2017-01-19 17:08:52', 'deleted_at' => '2017-01-19 17:08:52')
        );

    }
}
