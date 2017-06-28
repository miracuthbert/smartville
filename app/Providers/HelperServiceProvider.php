<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * @param $helpers
     */
    protected $helpers = [
        'ProductHelpers',
        'ActivePage',
        'BillingHelpers',
        'NotificationHelpers',
        'ForumHelpers',
        'CategoryHelpers',
        'AdminHelpers',
    ];


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->helpers as $helper) {
            $helper_path = app_path() . '/Helpers/' . $helper . '.php';

            if (\File::isFile($helper_path)) {
                require_once $helper_path;
            }
        }
    }
}
