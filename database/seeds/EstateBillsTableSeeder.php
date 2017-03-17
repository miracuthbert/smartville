<?php

use Illuminate\Database\Seeder;

class EstateBillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estate_bills = \App\EstateBill::create(
            array('id' => '1', 'company_app_id' => '1', 'title' => 'Water', 'summary' => 'Utility bill for water.', 'description' => NULL, 'billing_interval' => '1', 'interval_type' => 'month', 'billing_amount' => '100', 'properties' => '0', 'bill_plan' => '1', 'auto_billing' => '0', 'billing_reminder' => '30', 'status' => '1', 'created_at' => '2017-01-28 14:42:58', 'updated_at' => '2017-01-28 17:19:16', 'deleted_at' => NULL));

        $estate_bills = \App\EstateBill::create(
            array('id' => '2', 'company_app_id' => '1', 'title' => 'Mainteinance', 'summary' => 'Bill for property mainteinance.', 'description' => NULL, 'billing_interval' => '1', 'interval_type' => 'month', 'billing_amount' => '200', 'properties' => '1', 'bill_plan' => '0', 'auto_billing' => '0', 'billing_reminder' => '1', 'status' => '1', 'created_at' => '2017-01-28 15:18:34', 'updated_at' => '2017-01-28 17:19:14', 'deleted_at' => NULL ));
    }
}
