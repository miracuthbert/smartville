<?php

namespace App\Providers;

use App\AppSubscriptionHandler;
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
