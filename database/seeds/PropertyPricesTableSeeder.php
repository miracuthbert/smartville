<?php

use Illuminate\Database\Seeder;

class PropertyPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '1', 'property_id' => '1', 'price' => '10000.00', 'status' => '1', 'created_at' => '2017-01-18 04:20:16', 'updated_at' => '2017-01-18 04:20:16', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '2', 'property_id' => '2', 'price' => '12000.00', 'status' => '1', 'created_at' => '2017-01-18 04:29:42', 'updated_at' => '2017-01-18 04:29:42', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '3', 'property_id' => '3', 'price' => '10000.00', 'status' => '1', 'created_at' => '2017-01-18 04:30:31', 'updated_at' => '2017-01-18 04:30:31', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '4', 'property_id' => '4', 'price' => '120000.00', 'status' => '1', 'created_at' => '2017-01-18 04:31:14', 'updated_at' => '2017-01-18 04:31:14', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '5', 'property_id' => '5', 'price' => '10000.00', 'status' => '1', 'created_at' => '2017-01-18 04:34:41', 'updated_at' => '2017-01-18 04:34:41', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '6', 'property_id' => '6', 'price' => '100000.00', 'status' => '1', 'created_at' => '2017-01-18 04:49:22', 'updated_at' => '2017-01-18 04:49:22', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '7', 'property_id' => '7', 'price' => '100000.00', 'status' => '1', 'created_at' => '2017-01-18 05:05:01', 'updated_at' => '2017-01-18 05:05:01', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '8', 'property_id' => '8', 'price' => '10000.00', 'status' => '1', 'created_at' => '2017-01-18 05:24:38', 'updated_at' => '2017-01-18 05:24:38', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '9', 'property_id' => '9', 'price' => '10000.00', 'status' => '1', 'created_at' => '2017-01-18 05:28:51', 'updated_at' => '2017-01-18 05:28:51', 'deleted_at' => NULL)
        );

        $property_prices = \App\Models\v1\Property\PropertyPrice::create(
            array('id' => '10', 'property_id' => '10', 'price' => '10000.00', 'status' => '1', 'created_at' => '2017-01-18 05:29:44', 'updated_at' => '2017-01-18 05:29:44', 'deleted_at' => NULL)
        );
    }
}
