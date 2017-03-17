<?php

use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $amenities = \App\Amenity::create(
            array('id' => '1', 'company_app_id' => '1', 'title' => 'Parking', 'description' => 'Free parking for tenants only. Maximum 1 vehicle.', 'status' => '1', 'created_at' => '2017-01-16 19:35:30', 'updated_at' => '2017-01-16 20:02:03', 'deleted_at' => NULL)
        );

        $amenities = \App\Amenity::create(
            array('id' => '2', 'company_app_id' => '1', 'title' => 'Free Internet', 'description' => 'Free wifi and ethernet is available within the compound.', 'status' => '1', 'created_at' => '2017-01-17 15:21:04', 'updated_at' => '2017-01-17 15:21:04', 'deleted_at' => NULL)
        );

        $amenities = \App\Amenity::create(
            array('id' => '3', 'company_app_id' => '1', 'title' => 'Garbage Collection', 'description' => 'Free garbage collection for you.', 'status' => '1', 'created_at' => '2017-01-18 16:39:49', 'updated_at' => '2017-01-18 16:39:49', 'deleted_at' => NULL)
        );
    }
}
