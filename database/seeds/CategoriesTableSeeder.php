<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * ----------------------------------------------------------------------------
         * Estate Type Categories
         * @rental
         * @hostel
         * @billing
         * ----------------------------------------------------------------------------
         */
        //Rental
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Rental";
        $category->categorable_type = \App\ProductCategory::class;
        $category->save();

        //Hostel
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Hostel";
        $category->categorable_type = \App\ProductCategory::class;
        $category->save();

        //Billing
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Billing";
        $category->categorable_type = \App\ProductCategory::class;
        $category->save();

        /**
         * ----------------------------------------------------------------------------
         * Monetization Categories
         * @freemium
         * @pay_per_item
         * @in_app_purchasing(IAP)
         * @subscription
         * ----------------------------------------------------------------------------
         */
        //Freemium
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Freemium";
        $category->categorable_type = \App\Monetization::class;
        $category->save();

        //Premium
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Premium";
        $category->categorable_type = \App\Monetization::class;
        $category->save();

        //IAP
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "In-App Purchasing (IAP)";
        $category->categorable_type = \App\Monetization::class;
        $category->save();

        //Subscription
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Subscription";
        $category->categorable_type = \App\Monetization::class;
        $category->save();

        /**
         * ----------------------------------------------------------------------------
         * Property Type Categories
         * @Apartment
         * @Office Space
         * @Stall
         * @Restaurant
         * @Single Family Home
         * @Extended Family Home
         * ----------------------------------------------------------------------------
         */
        //Apartment
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Apartment";
        $category->categorable_type = \App\PropertyType::class;
        $category->save();

        //Office Space
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Office Space";
        $category->categorable_type = \App\PropertyType::class;
        $category->save();

        //Stall
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Stall";
        $category->categorable_type = \App\PropertyType::class;
        $category->save();

        //Restaurant
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Restaurant";
        $category->categorable_type = \App\PropertyType::class;
        $category->save();

        //Single Family Home
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Single Family Home";
        $category->categorable_type = \App\PropertyType::class;
        $category->save();

        //Extended Family Home
        $category = new \App\Models\v1\Shared\Category();
        $category->title = "Extended Family Home";
        $category->categorable_type = \App\PropertyType::class;
        $category->save();

    }
}
