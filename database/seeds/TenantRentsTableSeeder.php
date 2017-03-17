<?php

use Illuminate\Database\Seeder;

class TenantRentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $estate_rents = \App\TenantRent::create(
            array('id' => '1', 'tenant_property_id' => '1', 'property_id' => '2', 'details' => NULL, 'amount' => '12000.00', 'date_from' => '2017-01-08', 'date_to' => '2017-02-08', 'date_due' => '2017-02-05', 'hash' => '$2y$10$7xtkj/I.juW7pZEk4v/t/.uYpgVrZs1ZhxH.rZjruKoaWQ6kTM1Ta', 'status' => '0', 'created_at' => '2017-01-25 19:32:30', 'updated_at' => '2017-01-26 18:55:04', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '2', 'tenant_property_id' => '1', 'property_id' => '2', 'details' => NULL, 'amount' => '12000.00', 'date_from' => '2017-02-08', 'date_to' => '2017-03-08', 'date_due' => '2017-03-05', 'hash' => '$2y$10$NKY1wQfs07R9Pf6JIEClFOQkLt5eISZFyP5S2VIZlc4bIbHGUQlX.', 'status' => '0', 'created_at' => '2017-01-25 19:32:31', 'updated_at' => '2017-01-25 19:32:31', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '3', 'tenant_property_id' => '1', 'property_id' => '2', 'details' => NULL, 'amount' => '12000.00', 'date_from' => '2017-03-08', 'date_to' => '2017-04-08', 'date_due' => '2017-04-05', 'hash' => '$2y$10$0XSOT01iOXYM.UnoWgNHvucTgRNT1m5DCrk6sqnTTuM./hlJEH5N.', 'status' => '0', 'created_at' => '2017-01-25 19:32:31', 'updated_at' => '2017-01-25 19:32:31', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '4', 'tenant_property_id' => '1', 'property_id' => '2', 'details' => NULL, 'amount' => '12000.00', 'date_from' => '2017-04-08', 'date_to' => '2017-05-08', 'date_due' => '2017-04-05', 'hash' => '$2y$10$2iqe9latK/b550BAl6KaJeVaW7V2K3ffk6yCFQQNOKhTpe8lXYNOq', 'status' => '0', 'created_at' => '2017-01-25 19:32:32', 'updated_at' => '2017-01-25 19:32:32', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '5', 'tenant_property_id' => '2', 'property_id' => '3', 'details' => NULL, 'amount' => '10000.00', 'date_from' => '2017-01-09', 'date_to' => '2017-02-09', 'date_due' => '2017-02-05', 'hash' => '$2y$10$ckUI8j6l58XUPz/khu46DeVrh25vwUDLqQnhncNeqz.VRjOyPmlHC', 'status' => '0', 'created_at' => '2017-01-25 19:32:32', 'updated_at' => '2017-01-25 19:32:32', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '6', 'tenant_property_id' => '2', 'property_id' => '3', 'details' => NULL, 'amount' => '10000.00', 'date_from' => '2017-02-09', 'date_to' => '2017-03-09', 'date_due' => '2017-03-05', 'hash' => '$2y$10$/OZY3W1ZLchjhY5pnq4j/OIAn5k5Qf6u/vNy9QEnRfi0I1YVLMYi2', 'status' => '0', 'created_at' => '2017-01-25 19:32:33', 'updated_at' => '2017-01-25 19:32:33', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '7', 'tenant_property_id' => '2', 'property_id' => '3', 'details' => NULL, 'amount' => '10000.00', 'date_from' => '2017-03-09', 'date_to' => '2017-04-09', 'date_due' => '2017-04-05', 'hash' => '$2y$10$MeQ0XjVfs4RMwDedb7zb1OIA1S45zVOL6rUxb/JbPEEEcv.xWG8AO', 'status' => '0', 'created_at' => '2017-01-25 19:32:33', 'updated_at' => '2017-01-25 19:32:33', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '8', 'tenant_property_id' => '2', 'property_id' => '3', 'details' => NULL, 'amount' => '10000.00', 'date_from' => '2017-04-09', 'date_to' => '2017-05-09', 'date_due' => '2017-04-05', 'hash' => '$2y$10$De.RffB9xuGKkDaxZ4k7.eBdlt7cLoDK92JEDLRrdYATFj7ePkzu6', 'status' => '0', 'created_at' => '2017-01-25 19:32:33', 'updated_at' => '2017-01-26 19:03:12', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '45', 'tenant_property_id' => '3', 'property_id' => '9', 'details' => NULL, 'amount' => '10000.00', 'date_from' => '2017-07-08', 'date_to' => '2017-08-08', 'date_due' => '2017-07-15', 'hash' => '$2y$10$cfRMSFkRiLrCUDftxvcNIu4fCraXHAnNNrB.TEDo01.8FbnWxhiHC', 'status' => '0', 'created_at' => '2017-01-26 23:49:50', 'updated_at' => '2017-01-26 23:49:50', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '46', 'tenant_property_id' => '3', 'property_id' => '9', 'details' => NULL, 'amount' => '10000.00', 'date_from' => '2017-08-08', 'date_to' => '2017-09-08', 'date_due' => '2017-08-15', 'hash' => '$2y$10$yKx8Ve5iOrfNJJoIwoI3t.neQAtpgBk2hrEaIET/fnwScX280lMea', 'status' => '0', 'created_at' => '2017-01-26 23:49:50', 'updated_at' => '2017-01-26 23:49:50', 'deleted_at' => NULL)
        );

        $estate_rents = \App\TenantRent::create(
            array('id' => '47', 'tenant_property_id' => '3', 'property_id' => '9', 'details' => NULL, 'amount' => '10000.00', 'date_from' => '2017-09-08', 'date_to' => '2017-10-08', 'date_due' => '2017-09-15', 'hash' => '$2y$10$ccK48jjZiL4g.iHQeA1G/ulp75CeiqAve5Kr2V/YSpg1.i75FQrLa', 'status' => '0', 'created_at' => '2017-01-26 23:49:51', 'updated_at' => '2017-01-26 23:49:51', 'deleted_at' => NULL)
        );

    }
}
