<?php

use Illuminate\Database\Seeder;

class ProductFeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '1', 'product_id' => '1', 'feature' => 'Property Grouping', 'details' => 'Allows you to group properties according to location or other criteria.', 'value' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-14 16:18:07', 'updated_at' => '2017-01-14 17:34:52', 'deleted_at' => NULL)
        );
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '2', 'product_id' => '1', 'feature' => 'Lease Manager', 'details' => 'Allows to create, edit and make changes to tenants leases.', 'value' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-14 16:21:40', 'updated_at' => '2017-01-14 18:28:29', 'deleted_at' => NULL)
        );
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '4', 'product_id' => '1', 'feature' => 'Property Manager', 'details' => 'Allows to add, edit and manage your company\'s properties.', 'value' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-14 18:40:10', 'updated_at' => '2017-01-14 18:40:10', 'deleted_at' => NULL)
        );
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '5', 'product_id' => '1', 'feature' => 'Billing and Invoicing', 'details' => 'Allows you to create and send invoices.', 'value' => NULL, 'unit' => NULL, 'status' => '1', 'created_at' => '2017-01-14 18:41:45', 'updated_at' => '2017-01-14 19:12:56', 'deleted_at' => NULL)
        );
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '12', 'product_id' => '1', 'feature' => 'Virtual Inspector', 'details' => 'Allows property managers to inspect properties virtually, by customizing a series of regular inspections to be done by the tenant.', 'value' => NULL, 'unit' => NULL, 'status' => '0', 'created_at' => '2017-01-14 18:58:28', 'updated_at' => '2017-01-14 19:02:15', 'deleted_at' => NULL)
        );
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '13', 'product_id' => '1', 'feature' => 'Appointment Scheduler', 'details' => 'Allows people to book and schedule appointments to checkout a property.', 'value' => NULL, 'unit' => NULL, 'status' => '0', 'created_at' => '2017-01-14 19:06:03', 'updated_at' => '2017-01-14 19:06:20', 'deleted_at' => NULL)
        );
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '14', 'product_id' => '1', 'feature' => 'Booking Service', 'details' => 'Allows you to accept, decline and manage property bookings.', 'value' => NULL, 'unit' => NULL, 'status' => '0', 'created_at' => '2017-01-14 19:14:02', 'updated_at' => '2017-01-14 19:14:16', 'deleted_at' => NULL)
        );
        $product_features = \App\Models\v1\Product\ProductFeature::create
        (
            array('id' => '15', 'product_id' => '1', 'feature' => 'Test', 'details' => 'Test feature', 'value' => NULL, 'unit' => NULL, 'status' => '0', 'created_at' => '2017-01-15 15:12:58', 'updated_at' => '2017-01-15 15:12:58', 'deleted_at' => NULL)
        );
    }
}
