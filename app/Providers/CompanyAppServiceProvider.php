<?php

namespace App\Providers;

use App\AppSubscriptionHandler;
use App\Handlers\AppBillingHandler;
use App\Handlers\AppRentalHandler;
use Illuminate\Support\ServiceProvider;

class CompanyAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //handle ended subscription
//        AppSubscriptionHandler::subscriptionEnd();
//        AppBillingHandler::billingDayReminder();
//        AppBillingHandler::billsDueReminder();
//        AppBillingHandler::billsPastDueReminder();
//        AppRentalHandler::rentDueReminder();
//        AppRentalHandler::rentPastDueReminder();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
