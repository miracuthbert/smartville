<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = \App\Company::create(
            array('id' => '1', 'title' => 'Test Company', 'country' => '254', 'city' => 'Nairobi', 'state' => 'Nairobi', 'zipcode' => '00200', 'address' => '50200', 'phone' => '0724308266', 'email' => 'test@testcompany.com', 'listing' => '0', 'booking' => '0', 'activated' => '0', 'status' => '1', 'created_at' => '2017-01-16 02:41:13', 'updated_at' => '2017-02-16 13:23:37', 'deleted_at' => NULL)
        );

        $companies = \App\Company::create(
            array('id' => '2', 'title' => 'Real Estate', 'country' => '255', 'city' => 'Arusha', 'state' => 'Arusha', 'zipcode' => '', 'address' => 'P.O. Box 2350', 'phone' => '0766038905', 'email' => 'realtest@test.com', 'listing' => '0', 'booking' => '0', 'activated' => '0', 'status' => '1', 'created_at' => '2017-02-15 18:15:20', 'updated_at' => '2017-02-15 18:15:20', 'deleted_at' => NULL)
        );

        $companies = \App\Company::create(
            array('id' => '3', 'title' => 'Wind Gate', 'country' => '255', 'city' => 'Arusha', 'state' => 'Arusha', 'zipcode' => '', 'address' => 'P.O. Box 2350', 'phone' => '0766038905', 'email' => 'contact@windgate.com', 'listing' => '0', 'booking' => '0', 'activated' => '0', 'status' => '1', 'created_at' => '2017-02-15 18:33:02', 'updated_at' => '2017-02-16 13:23:24', 'deleted_at' => NULL)
        );

        $companies = \App\Company::create(
            array('id' => '4', 'title' => 'Test Company 2', 'country' => '255', 'city' => 'Arusha', 'state' => 'Arusha', 'zipcode' => '', 'address' => '', 'phone' => '0766038905', 'email' => 'test@test.com', 'listing' => '0', 'booking' => '0', 'activated' => '0', 'status' => '1', 'created_at' => '2017-02-15 18:37:17', 'updated_at' => '2017-02-16 12:43:41', 'deleted_at' => NULL)
        );
    }
}
