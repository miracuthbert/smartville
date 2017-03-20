<?php

namespace App\ViewComposers;

use App\Category;
use App\Monetization;
use App\Product;
use App\ProductCategory;
use App\PropertyType;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MainComposer
{
    /**
     * MainComposer constructor.
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        //Load Model in each view
        $categories = Category::where('status', 1)->where('categorable_type', ProductCategory::class)->get();
        $payments = Category::where('status', 1)->where('categorable_type', Monetization::class)->get();
        $property_types = Category::where('status', 1)->where('categorable_type', PropertyType::class)->get();
        $apps = Product::where('status', 1)->get();
        $apps_coming = Product::where('coming_soon', 1)->get();

        //load view
        $view
            ->with('app_categories', $categories)
            ->with('app_payments', $payments)
            ->with('app_products', $apps)
            ->with('apps_coming', $apps_coming)
            ->with('property_types', $property_types);

        if (Auth::check()) {
            //user
            $user = Auth::user();

            //avatar
            $avatar = $user->avatar;

            //notifications
            $notifications = Auth::user()->notifications()->orderBy('created_at', 'DESC')->paginate();
            $mini_notifications = Auth::user()->notifications()->orderBy('created_at', 'DESC')->paginate(4);
            $unread_notifications = Auth::user()->unreadNotifications()->orderBy('created_at', 'DESC')->paginate();

            //view
            $view
                ->with('avatar', $avatar)
                ->with('notifications', $notifications)
                ->with('unread_notifications', $unread_notifications)
                ->with('mini_notifications', $mini_notifications);
        }


    }
}