<?php

use Illuminate\Database\Seeder;

class ProductPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_plans = \App\Models\v1\Product\ProductPlan::create(
            array('id' => '1', 'product_id' => '1', 'title' => 'Baby', 'summary' => 'A plan that caters for small property managers.', 'description' => 'A plan that caters for small property managers.', 'price' => '45.00', 'limit' => '30', 'trial' => '0', 'trial_days' => '14', 'status' => '1', 'created_at' => '2017-01-15 18:04:01', 'updated_at' => '2017-01-30 06:21:02', 'deleted_at' => NULL)
        );

        $product_plans = \App\Models\v1\Product\ProductPlan::create(
            array('id' => '2', 'product_id' => '1', 'title' => 'Basic', 'summary' => 'Suitable for small property managers with about 50 properties.', 'description' => 'Suitable for small property managers with about 50 properties.', 'price' => '65.00', 'limit' => '50', 'trial' => '1', 'trial_days' => '14', 'status' => '1', 'created_at' => '2017-02-11 15:44:18', 'updated_at' => '2017-02-11 15:44:18', 'deleted_at' => NULL)
        );
    }
}
