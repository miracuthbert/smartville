<?php

use Illuminate\Database\Seeder;

class TenantBillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tenant_bill = \App\TenantBill::create(
            array(
                'id' => '1',
                'tenant_property_id' => '4',
                'property_id' => '4',
                'bill_id' => '2',
                'details' => NULL,
                'previous_usage' => '0',
                'current_usage' => '0',
                'unit_cost' => '200',
                'date_from' => '2017-01-09',
                'date_to' => '2017-02-09',
                'date_due' => '2017-02-20',
                'hash' => '$2y$10$3c.3vvmZ4tcSCoHZs0SXI.vh9r0g\/um7bMJHJ9GH2FBssAiS\/.HKG',
                'status' => '0',
                'created_at' => '2017-01-29 04:54:54',
                'updated_at' => '2017-01-29 06:37:51',
                'deleted_at' => NULL
            )
        );

        $tenant_bill = \App\TenantBill::create(
            array(
                'id' => '3',
                'tenant_property_id' => '1',
                'property_id' => '2',
                'bill_id' => '1',
                'details' => NULL,
                'previous_usage' => '10',
                'current_usage' => '13',
                'unit_cost' => '100',
                'date_from' => '2017-01-09',
                'date_to' => '2017-02-09',
                'date_due' => '2017-02-15',
                'hash' => '$2y$10$DO3S438NyrRUiWJq1htCYOZWLRwQOoP0P1pysbh2dOoTG9hQgQRZu',
                'status' => '1',
                'created_at' => '2017-01-29 04:56:47',
                'updated_at' => '2017-01-29 06:17:10',
                'deleted_at' => NULL
            )
        );

        $tenant_bill = \App\TenantBill::create(
            array(
                'id' => '4',
                'tenant_property_id' => '2',
                'property_id' => '3',
                'bill_id' => '1',
                'details' => NULL,
                'previous_usage' => '5',
                'current_usage' => '8',
                'unit_cost' => '100',
                'date_from' => '2017-01-09',
                'date_to' => '2017-02-09',
                'date_due' => '2017-02-15',
                'hash' => '$2y$10$c.4w5Q6Etk72IhN.lgynr.qMK7o3yoMR56ZT0BUTdPp4GddBFFYMq',
                'status' => '0',
                'created_at' => '2017-01-29 04:56:47',
                'updated_at' => '2017-01-29 15:40:18',
                'deleted_at' => NULL
            )
        );

    }
}
