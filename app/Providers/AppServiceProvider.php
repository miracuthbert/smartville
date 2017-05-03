<?php

namespace App\Providers;

use App\Models\Forum\ForumTopic;
use App\Models\Post\PostAudience;
use App\Models\Site\Comment;
use App\Models\Site\Tag;
use App\Models\Site\Vote;
use App\Models\v1\Documentation\Manual;
use App\Models\v1\Documentation\ManualChapter;
use App\Models\v1\Documentation\ManualPage;
use App\Models\v1\Product\Product;
use App\Models\v1\Product\ProductCategory;
use App\Models\v1\Property\PropertyType;
use App\Models\v1\Shared\Category;
use App\Models\v1\Shared\Monetization;
use App\Models\v1\Tenant\TenantBill;
use App\Models\v1\Tenant\TenantProperty;
use App\Models\v1\Tenant\TenantRent;
use App\Observers\Tenant\TenantPropertyObserver;
use App\Observers\TenantBillObserver;
use App\Observers\TenantRentObserver;
use App\Role;
use App\User;
use App\UserRole;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        /**
         * Register Observers Below
         */
        //Tenant Rent Observer
        TenantRent::observe(TenantRentObserver::class);

        //Tenant Property Observer
        TenantProperty::observe(TenantPropertyObserver::class);

        //Tenant Bill Observer
        TenantBill::observe(TenantBillObserver::class);

        /**
         * Add Polymorphic Relations Below
         */
        //morph map
        Relation::morphMap([
            'products' => Product::class,
            'product_categories' => ProductCategory::class,
            'property_types' => PropertyType::class,
            'monetizations' => Monetization::class,
            'post_audiences' => PostAudience::class,
            'forum_topics' => ForumTopic::class,
            'comments' => Comment::class,
            'votes' => Vote::class,
            'tags' => Tag::class,
            'manuals' => Manual::class,
            'manual_chapters' => ManualChapter::class,
            'manual_pages' => ManualPage::class,
            'users' => User::class,
            'roles' => Role::class,
            'user_roles' => UserRole::class,
        ]);

        //update
        Category::where('categorable_type', ProductCategory::class)->update(['categorable_type' => 'product_categories']);
        Category::where('categorable_type', Monetization::class)->update(['categorable_type' => 'monetizations']);
        Category::where('categorable_type', PropertyType::class)->update(['categorable_type' => 'property_types']);
        Manual::where('manualable_type', Product::class)->update(['manualable_type' => 'products']);
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
