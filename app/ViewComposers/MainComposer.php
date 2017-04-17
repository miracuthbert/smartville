<?php

namespace App\ViewComposers;

use App\Models\v1\Documentation\Manual;
use App\Models\v1\Shared\Category;
use App\Models\v1\Shared\Monetization;
use App\Models\v1\Product\Product;
use App\Models\v1\Product\ProductCategory;
use App\Models\v1\Property\PropertyType;
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
        $manuals = Manual::where('status', 1)->get();

        //load view
        $view
            ->with('app_categories', $categories)
            ->with('app_payments', $payments)
            ->with('app_products', $apps)
            ->with('apps_coming', $apps_coming)
            ->with('manuals', $manuals)
            ->with('property_types', $property_types);

        if (Auth::check()) {
            //user
            $user = Auth::user();

            //avatar
            $avatar = $user->avatar;

            //notifications
            $notifications = Auth::user()
                ->notifications()
                ->orderBy('created_at', 'DESC')
                ->paginate();
            //notifications: admin
            $admin_notifications = Auth::user()
                ->notifications()
                ->where('data', 'like', '%bug%')
                ->orWhere('data', 'like', '%contact%')
                ->orderBy('created_at', 'DESC')
                ->paginate();
            //notifications: admin unread
            $admin_un_notifications = Auth::user()
                ->notifications()
                ->where('data', 'like', '%bug%')
                ->orWhere('data', 'like', '%contact%')
                ->whereNull('read_at')
                ->orderBy('created_at', 'DESC')
                ->paginate();
            //notifications: admin unread mini
            $admin_mini_notifications = Auth::user()
                ->notifications()
                ->where('data', 'like', '%bug%')
                ->orWhere('data', 'like', '%contact%')
                ->whereNull('read_at')
                ->orderBy('created_at', 'DESC')
                ->paginate(4);
            //notifications: user
            $user_notifications = Auth::user()
                ->notifications()
                ->where('data', 'like', '%forum%')
                ->orWhere('data', 'like', '%tenant bill%')
                ->orderBy('created_at', 'DESC')
                ->paginate();

            //notifications: mini unread
            $mini_notifications = Auth::user()
                ->notifications()
                ->where('data', 'like', '%forum%')
                ->whereNull('read_at')
                ->orderBy('created_at', 'DESC')
                ->paginate(4);

            //notifications: user unread
            $unread_notifications = Auth::user()
                ->unreadNotifications()
                ->orderBy('created_at', 'DESC')
                ->paginate();

            //view
            $view
                ->with('avatar', $avatar)
                ->with('notifications', $notifications)
                ->with('unread_notifications', $unread_notifications);

            //view
//            $view
//                ->with('avatar', $avatar)
////                ->with('notifications', $notifications)
//                ->with('admin_notifications', $admin_notifications)
//                ->with('admin_un_notifications', $admin_un_notifications)
//                ->with('admin_mini_notifications', $admin_mini_notifications)
//                ->with('user_notifications', $user_notifications)
//                ->with('mini_notifications', $mini_notifications)
//                ->with('unread_notifications', $unread_notifications);
        }


    }
}