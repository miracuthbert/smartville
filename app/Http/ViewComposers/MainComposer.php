<?php

namespace App\Http\ViewComposers;

use App\Models\Post\PostAudience;
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

    private $categories;
    private $apps;
    private $apps_coming_soon;
    private $manuals;
    private $avatar;
    private $notifications;
    private $unread_notifications;

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $app_categories = collect();
        $payments = collect();
        $common_property_categories = collect();
        $hostel_property_categories = collect();
        $post_audiences = collect();

        //categories
        if (!$this->categories) {
            $this->categories = Category::with('categories')->where('parent', 1)->where('status', 1)->get();

            $app_categories = $this->categories->where('slug', 'apps')->first()->categories;

            $payments = $this->categories->where('slug', 'monetization')->first()->categories;

            $common_property_categories = $this->categories->where('slug', 'property-types')->first()->categories;

            $hostel_property_categories = $this->categories->where('slug', 'hostel-property-categories')->first()->categories;

            $post_audiences = $this->categories->where('slug', 'post-audiences')->first()->categories;
        }

        //apps
        if (!$this->apps) {
            $this->apps = Product::where('status', 1)->get();
        }

        //apps coming soon
        if (!$this->apps_coming_soon) {
            $this->apps_coming_soon = Product::where('coming_soon', 1)->get();
        }

        //manuals
        if (!$this->manuals) {
            $this->manuals = Manual::where('status', 1)->orderBy('index', 'ASC')->get();
        }

        //attach content with loaded view
        $view
            ->with('app_categories', $app_categories)
            ->with('app_payments', $payments)
            ->with('app_products', $this->apps)
            ->with('apps_coming', $this->apps_coming_soon)
            ->with('manuals', $this->manuals)
            ->with('property_types', $common_property_categories)
            ->with('hostel_property_categories', $hostel_property_categories)
            ->with('post_audiences', $post_audiences);

        if (Auth::check()) {
            //user
            $user = Auth::user();

            //avatar
            if (!$this->avatar) {
                $this->avatar = $user->avatar;
            }

            //notifications
            if (!$this->notifications) {
                $this->notifications = $user->notifications()
                    ->orderBy('created_at', 'DESC')
                    ->paginate();
            }

            //notifications: user unread
            if (!$this->unread_notifications) {
                $this->unread_notifications = $user
                    ->unreadNotifications()
                    ->orderBy('created_at', 'DESC')
                    ->paginate();
            }

            //view
            $view
                ->with('avatar', $this->avatar)
                ->with('notifications', $this->notifications)
                ->with('unread_notifications', $this->unread_notifications);
        }


    }
}