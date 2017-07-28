<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = \App\Models\v1\Product\Product::create(
            array('id' => '1', 'category_id' => '1', 'monetization_id' => '7', 'title' => 'Rental Management App', 'slug' => 'rental-management-app', 'summary' => 'A full app with rental property manager & grouping; lease manager; billing and invoice service and a tenant panel where tenants can check and keep track of their bills and invoices.', 'desc' => 'A full packaged rental management app.', 'app' => '1', 'icon' => 'fa-home', 'page' => 'rental', 'version_name' => 'Mercury', 'version_no' => '1.00', 'mode' => '1', 'coming_soon' => '0', 'status' => '1', 'created_at' => '2017-01-13 23:59:39', 'updated_at' => '2017-02-09 13:36:39', 'deleted_at' => NULL)
        );
        $product = \App\Models\v1\Product\Product::create(
            array('id' => '2', 'category_id' => '1', 'monetization_id' => '7', 'title' => 'Hostel Management App', 'slug' => 'hostel-management-app', 'summary' => 'An app suitable for hostels; with grouping of properties by rooms and beds; coupled with billing and invoice services. Also a tenant dashboard them to view and track their bills, invoices among other services.', 'desc' => 'Suitable for schools and hostel setup properties.', 'app' => '1', 'icon' => ' fa-building', 'page' => 'hostel', 'version_name' => 'Mercury', 'version_no' => '1.00', 'mode' => '0', 'coming_soon' => '0', 'status' => '0', 'created_at' => '2017-01-14 00:24:37', 'updated_at' => '2017-02-09 13:36:08', 'deleted_at' => NULL)
        );
        $product = \App\Models\v1\Product\Product::create(
            array('id' => '3', 'category_id' => '1', 'monetization_id' => '7', 'title' => 'Export Invoice To PDF', 'slug' => 'export-invoice-to-pdf', 'summary' => 'A feature that allows both tenants and property managers to download invoices in PDF format.', 'desc' => 'Allows exporting of invoices to PDF format.', 'app' => '1', 'icon' => 'fa-file-pdf-o', 'page' => '', 'version_name' => 'Venus', 'version_no' => '0.10', 'mode' => '0', 'coming_soon' => '1', 'status' => '0', 'created_at' => '2017-01-31 10:57:50', 'updated_at' => '2017-01-31 11:08:25', 'deleted_at' => NULL)
        );
    }
}
