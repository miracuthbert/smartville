<?php

namespace App\Providers;

use App\Category;
use App\Monetization;
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
//        //Load Model in each view
//        $categories = Category::where('status', 1)->where('categorable_type', ProductCategory::class)->get();
//        $payments = Category::where('status', 1)->where('categorable_type', Monetization::class)->get();
//        $property_types = Category::where('status', 1)->where('categorable_type', PropertyType::class)->get();
//        $apps = Product::where('status', 1)->get();
//        $apps_coming = Product::where('coming_soon', 1)->get();
////        $notifications = Auth::user()->notifications()->orderBy('created_at', 'DESC')->paginate();
////        $mini_notifications = Auth::user()->notifications()->orderBy('created_at', 'DESC')->paginate();
//
//        View::share('app_categories', $categories);
//        View::share('app_payments', $payments);
//        View::share('app_products', $apps);
//        View::share('apps_coming', $apps_coming);
//        View::share('property_types', $property_types);
////        View::share('notifications', $notifications);
////        View::share('mini_notifications', $mini_notifications);
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
