<?php

namespace App\Providers;

use App\Category;
use App\Models\v1\Tenant\TenantBill;
use App\Monetization;
use App\Observers\TenantBillObserver;
use App\Product;
use App\ProductCategory;
use App\PropertyType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Tenant Bill Observer
        TenantBill::observe(TenantBillObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
