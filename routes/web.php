<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Home Route
Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

//Services Route
Route::get('/apps-services', [
    'uses' => 'HomeController@services',
    'as' => 'services'
]);

//Service Route
Route::get('/apps-services/{id}', [
    'uses' => 'HomeController@product',
    'as' => 'service'
]);

//About Route
Route::get('/about', [
    'uses' => 'HomeController@about',
    'as' => 'about'
]);

//Contact Route
Route::get('/contact', [
    'uses' => 'HomeController@contact',
    'as' => 'contact'
]);

//Contact Send Route
Route::post('/send/message', [
    'uses' => 'HomeController@message',
    'as' => 'contact.send'
]);

//Date generator
Route::post('/date-generator', [
    'uses' => 'ParseController@dateParser',
    'as' => 'parse.date',
]);

////Date generator
//Route::get('/billing/reminders', [
//    'uses' => 'Estate\Rental\Bills\ReminderController@store',
//    'as' => 'billing.reminders',
//]);

/**
 * Support Resource Route
 */
Route::resource('support', 'Support\Test\SupportController');

/**
 * Support Bugs Resource Route
 */
Route::resource('support/bug', 'Support\Test\BugController', ['except' => [
    'destroy'
]]);

/**
 * Support Manuals Resource Route
 */
Route::resource('support/docs//manuals', 'Support\Documentation\ManualController', ['except' => [
    'create', 'store', 'edit', 'update', 'destroy',
]]);

/**
 * Support Manual Chapter Resource Route
 */
Route::resource('support/docs/{manual}/man_chapter', 'Support\Documentation\ManualChapterController', ['except' => [
    'create', 'store', 'edit', 'update', 'destroy',
]]);

/**
 * Support Manual Page Resource Route
 */
Route::resource('support/docs/{manual}/{chapter}/man_page', 'Support\Documentation\ManualPageController', ['except' => [
    'index', 'create', 'store', 'edit', 'update', 'destroy',
]]);


/**
 * ----------------------------------------------------------------
 * Forum Resource Route
 * ----------------------------------------------------------------
 */

//edit forum topic
Route::get('forum/{forum}/edit', [
    'uses' => 'Forum\User\PostController@edit',
    'as' => 'forum.edit',
]);

//update forum topic
Route::put('forum/{forum}', [
    'uses' => 'Forum\User\PostController@update',
    'as' => 'forum.update',
]);

//search
Route::get('forum/results', [
    'uses' => 'Forum\Search\SearchController@index',
    'as' => 'forum.search',
]);

//update forum topic status
Route::get('forum/status/{forum}', [
    'uses' => 'Forum\User\PostController@status',
    'as' => 'forum.status',
]);

//delete forum topic
Route::get('forum/delete/{forum}', [
    'uses' => 'Forum\User\PostController@destroy',
    'as' => 'forum.destroy',
]);

//forum resource routes
Route::resource('forum', 'Forum\ForumController', ['except' => [
    'edit', 'update', 'destroy'
]]);

/**
 * ----------------------------------------------------------------
 * Forum Author Route
 * ----------------------------------------------------------------
 */
Route::group(['prefix' => 'forum/author'], function () {

    //author posts
    Route::get('/index/{author?}', [
        'uses' => 'Forum\User\PostController@index',
        'as' => 'forum.author.index',
    ]);
});

/**
 * ----------------------------------------------------------------
 * Forum Comments Route
 * ----------------------------------------------------------------
 */
Route::group(['prefix' => 'forum/comments'], function () {

    //store comment
    Route::post('/', [
        'uses' => 'Forum\Comment\CommentController@store',
        'as' => 'forum.comment.store',
    ]);

    //comment vote
    Route::post('vote/{id}', [
        'uses' => 'Forum\Comment\VoteController@vote',
        'as' => 'forum.comment.vote',
    ]);

    //update comment
    Route::post('/update', [
        'uses' => 'Forum\Comment\CommentController@update',
        'as' => 'forum.comment.update',
    ]);

    //destroy comment
    Route::get('/destroy/{id}', [
        'uses' => 'Forum\Comment\CommentController@destroy',
        'as' => 'forum.comment.destroy',
    ]);
});

/**
 * -----------------------------------------------------------------
 * Admin Routes Group
 * -----------------------------------------------------------------
 */
Route::group(['prefix' => 'admin'], function () {

    //Get Admin Dashboard
    Route::get('dashboard', [
        'uses' => 'Admin\AdminController@getDashboard',
        'as' => 'admin.dashboard'
    ]);

    //Get Admin Notifications
    Route::get('user/notifications', [
        'uses' => 'Admin\User\NotificationController@index',
        'as' => 'admin.notifications'
    ]);

    //Mark Admin Notification As Read
    Route::get('user/notification/toggle/read/{id}', [
        'uses' => 'Admin\User\NotificationController@toggleRead',
        'as' => 'admin.notification.read'
    ]);

    //Admin Notification Destroy
    Route::get('user/notification/destroy/{id}', [
        'uses' => 'Admin\User\NotificationController@destroy',
        'as' => 'admin.notification.destroy'
    ]);

    //Get Admin Settings
    Route::get('settings', [
        'uses' => 'Admin\AdminController@getSettings',
        'as' => 'admin.settings'
    ]);

    //Get Admin contact message
    Route::get('contact/message/{id}', [
        'uses' => 'Admin\ContactController@message',
        'as' => 'admin.contact.message'
    ]);

    //Get Admin contact messages
    Route::get('contact/messages/{sort}', [
        'uses' => 'Admin\ContactController@index',
        'as' => 'admin.contact.messages'
    ]);

    /**
     * Category Routes
     */
    Route::get('category/destroy/{category}', [
        'uses' => 'Admin\Category\CategoryController@destroy',
        'as' => 'category.destroy',
    ]);

    Route::resource('category', 'Admin\Category\CategoryController', ['except' => [
        'destroy',
    ]]);

    /**
     * Company & Company Apps Routes
     */
    Route::group(['prefix' => 'companies'], function () {

        /**
         * Company Routes
         */
        Route::resource('admin_company', 'Admin\Company\CompanyController', ['except' => [
            'destroy',
        ]]);

        /**
         * Company Apps Routes
         */
        Route::resource('admin_company_app', 'Admin\Company\CompanyAppController', ['except' => [
            'destroy',
        ]]);
    });

    /**
     * Users Routes
     */
    Route::group(['prefix' => 'users'], function () {
        //View Users Route
        Route::get('index', [
            'uses' => 'Admin\UserController@index',
            'as' => 'admin.users'
        ]);

        //View User Route
        Route::get('user/{id}', [
            'uses' => 'Admin\UserController@view',
            'as' => 'admin.user.edit'
        ]);

        //Block User Route
        Route::get('user/delete/{id}', [
            'uses' => 'Admin\UserController@delete',
            'as' => 'admin.user.delete'
        ]);

        //Restore User Route
        Route::get('user/restore/{id}', [
            'uses' => 'Admin\UserController@restore',
            'as' => 'admin.user.restore'
        ]);
    });

    /**
     * App Products Routes
     */
    Route::group(['prefix' => 'apps/products'], function () {
        //Get Admin Add Product
        Route::get('add-new-app', [
            'uses' => 'Admin\ProductController@getCreate',
            'as' => 'admin.app.create'
        ]);

        //Post Admin Add Product
        Route::post('add-app', [
            'uses' => 'Admin\ProductController@store',
            'as' => 'admin.app.store'
        ]);

        //Get Admin Product
        Route::get('app/{id}', [
            'uses' => 'Admin\ProductController@getApp',
            'as' => 'admin.app.view'
        ]);

        //Get Admin Update Product Status
        Route::get('status/{id}', [
            'uses' => 'Admin\ProductController@toggleStatus',
            'as' => 'admin.app.status'
        ]);

        //Post Admin Update Product
        Route::post('update-app', [
            'uses' => 'Admin\ProductController@update',
            'as' => 'admin.app.update'
        ]);

        //Post Admin Delete Product
        Route::get('delete/{id}', [
            'uses' => 'Admin\ProductController@delete',
            'as' => 'admin.app.delete'
        ]);

        //Post Admin Delete Product
        Route::get('destroy/{id}', [
            'uses' => 'Admin\ProductController@destroy',
            'as' => 'admin.app.destroy'
        ]);

        //Post Admin Restore Product
        Route::get('restore/{id}', [
            'uses' => 'Admin\ProductController@restore',
            'as' => 'admin.app.restore'
        ]);

        //Get Admin Products
        Route::get('index/{sort}', [
            'uses' => 'Admin\ProductController@getApps',
            'as' => 'admin.apps'
        ]);
    });

    /**
     * App Features Routes
     */
    Route::group(['prefix' => 'app/features'], function () {
        //Post Admin Add App Feature
        Route::post('add-feature', [
            'uses' => 'Admin\AppFeatureController@store',
            'as' => 'admin.app.feature.store'
        ]);

        //Post Admin Update App Feature
        Route::post('update-feature', [
            'uses' => 'Admin\AppFeatureController@update',
            'as' => 'admin.app.feature.update'
        ]);

        //Post Admin Update App Feature Status
        Route::get('status/{id}', [
            'uses' => 'Admin\AppFeatureController@toggleStatus',
            'as' => 'admin.app.feature.status'
        ]);

        //Post Admin Delete App Feature
        Route::get('delete/{id}', [
            'uses' => 'Admin\AppFeatureController@delete',
            'as' => 'admin.app.feature.delete'
        ]);

        //Post Admin Restore App Feature
        Route::get('restore/{id}', [
            'uses' => 'Admin\AppFeatureController@restore',
            'as' => 'admin.app.feature.restore'
        ]);

        //Post Admin Destroy App Feature
        Route::get('destroy/{id}', [
            'uses' => 'Admin\AppFeatureController@destroy',
            'as' => 'admin.app.feature.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Admin Product Plan Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'app/plans'], function () {
        //Get Admin Create Plan
        Route::get('add-new-plan/{id}', [
            'uses' => 'Admin\ProductPlanController@create',
            'as' => 'admin.app.plan.create'
        ]);

        //Post Admin Add App Plan
        Route::post('add-plan', [
            'uses' => 'Admin\ProductPlanController@store',
            'as' => 'admin.app.plan.store'
        ]);

        //Get App Plan
        Route::get('plan/{id}', [
            'uses' => 'Admin\ProductPlanController@view',
            'as' => 'admin.app.plan.view'
        ]);

        //Get App Plan Features
        Route::get('plan/{id}/features', [
            'uses' => 'Admin\ProductPlanController@features',
            'as' => 'admin.app.plan.features'
        ]);

        //Post Admin Update App Feature
        Route::post('update-plan', [
            'uses' => 'Admin\ProductPlanController@update',
            'as' => 'admin.app.plan.update'
        ]);

        //Post Admin Update App Feature Status
        Route::get('plan/status/{id}', [
            'uses' => 'Admin\ProductPlanController@toggleStatus',
            'as' => 'admin.app.plan.status'
        ]);

        //Post Admin Delete App Feature
        Route::get('delete/{id}', [
            'uses' => 'Admin\ProductPlanController@delete',
            'as' => 'admin.app.plan.delete'
        ]);

        //Post Admin Restore App Feature
        Route::get('restore/{id}', [
            'uses' => 'Admin\ProductPlanController@restore',
            'as' => 'admin.app.plan.restore'
        ]);

        //Post Admin Destroy App Feature
        Route::get('destroy/{id}', [
            'uses' => 'Admin\ProductPlanController@destroy',
            'as' => 'admin.app.plan.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Admin App Plan Features
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'app/plan/features'], function () {
        //Post Admin Add App Plan Features
        Route::post('add-features', [
            'uses' => 'Admin\PlanFeatureController@store',
            'as' => 'admin.plan.feature.store'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Support Bug Routes
     * -----------------------------------------------------------------
     */
    Route::resource('bugs', 'Admin\Support\BugController');

    /**
     * -----------------------------------------------------------------
     * Manuals Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'docs/manual'], function () {
        //change page manual
        Route::post('change/pages', [
            'uses' => 'Admin\Documentation\ManualController@pages',
            'as' => 'manual.pages'
        ]);

        //restore manual
        Route::get('restore/{manual}', [
            'uses' => 'Admin\Documentation\ManualController@restore',
            'as' => 'manual.restore'
        ]);

        //delete manual
        Route::get('delete/{manual}', [
            'uses' => 'Admin\Documentation\ManualController@delete',
            'as' => 'manual.delete'
        ]);

        //destroy manual
        Route::get('destroy/{manual}', [
            'uses' => 'Admin\Documentation\ManualController@destroy',
            'as' => 'manual.destroy'
        ]);

        //update status for manual
        Route::get('status/{manual}', [
            'uses' => 'Admin\Documentation\ManualController@status',
            'as' => 'manual.status'
        ]);
    });

    Route::resource('docs//manual', 'Admin\Documentation\ManualController', ['except' => [
        'destroy',
    ]]);

    /**
     * -----------------------------------------------------------------
     * Manuals Chapters Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'docs/manual/manchapter'], function () {

        //manual chapters
        Route::get('/{manual?}/index', [
            'uses' => 'Admin\Documentation\ManualChapterController@index',
            'as' => 'manchapter.index'
        ]);

        //restore manual chapter
        Route::get('restore/{manual}', [
            'uses' => 'Admin\Documentation\ManualChapterController@restore',
            'as' => 'manchapter.restore'
        ]);

        //delete manual chapter
        Route::get('delete/{manchapter}', [
            'uses' => 'Admin\Documentation\ManualChapterController@delete',
            'as' => 'manchapter.delete'
        ]);

        //destroy manual chapter
        Route::get('destroy/{manchapter}', [
            'uses' => 'Admin\Documentation\ManualChapterController@destroy',
            'as' => 'manchapter.destroy'
        ]);

        //update status for manual chapter
        Route::get('status/{manchapter}', [
            'uses' => 'Admin\Documentation\ManualChapterController@status',
            'as' => 'manchapter.status'
        ]);
    });

    Route::resource('docs/manual/manchapter', 'Admin\Documentation\ManualChapterController', ['except' => [
        'index', 'destroy',
    ]]);

    /**
     * -----------------------------------------------------------------
     * Manuals Chapters Pages Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'docs/manual/chapter/manpage'], function () {

        //chapter pages
        Route::get('/{manchapter?}/index', [
            'uses' => 'Admin\Documentation\ManualPageController@index',
            'as' => 'manpage.index'
        ]);

        //restore manual page
        Route::get('restore/{manpage}', [
            'uses' => 'Admin\Documentation\ManualPageController@restore',
            'as' => 'manpage.restore'
        ]);

        //delete manual page
        Route::get('delete/{manpage}', [
            'uses' => 'Admin\Documentation\ManualPageController@delete',
            'as' => 'manpage.delete'
        ]);

        //destroy manual page
        Route::get('destroy/{manpage}', [
            'uses' => 'Admin\Documentation\ManualPageController@destroy',
            'as' => 'manpage.destroy'
        ]);

        //update status for manual page
        Route::get('status/{manpage}', [
            'uses' => 'Admin\Documentation\ManualPageController@status',
            'as' => 'manpage.status'
        ]);
    });

    Route::resource('docs/manual/chapter/manpage', 'Admin\Documentation\ManualPageController', ['except' => [
        'index', 'destroy',
    ]]);

});

/**
 * -----------------------------------------------------------------
 * Estate Rental App Routes Group
 * -----------------------------------------------------------------
 */
Route::group(['prefix' => 'estate/rental'], function () {

    //dashboard
    Route::get('dashboard/{id}', [
        'uses' => 'Estate\Company\CompanyAppController@index',
        'as' => 'estate.rental.dashboard'
    ]);

    //profile
    Route::get('profile/{id}', [
        'uses' => 'Estate\Company\CompanyAppController@edit',
        'as' => 'estate.rental.profile'
    ]);

    /**
     * -----------------------------------------------------------------
     * App Settings Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'settings'], function () {
        //settings
        Route::get('/index/{id}', [
            'uses' => 'Estate\Rental\App\SettingsController@index',
            'as' => 'estate.rental.settings'
        ]);

        //settings
        Route::post('/update/{id}', [
            'uses' => 'Estate\Rental\App\SettingsController@index',
            'as' => 'estate.rental.settings.update'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * App Admin Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'company.app.admin'], function () {

        /**
         * -----------------------------------------------------------------
         * App Admin Routes
         * -----------------------------------------------------------------
         */
        //Post Update App
        Route::post('update/app', [
            'uses' => 'Estate\Company\CompanyAppController@update',
            'as' => 'estate.rental.update'
        ]);

        //Post Update App Status
        Route::get('status/{id}', [
            'uses' => 'Estate\Company\CompanyAppController@toggleStatus',
            'as' => 'estate.rental.status'
        ]);

        //Get Delete App Feature
        Route::get('delete/{id}', [
            'uses' => 'Estate\Company\CompanyAppController@delete',
            'as' => 'estate.rental.delete'
        ]);

        //Get Restore App Feature
        Route::get('restore/{id}', [
            'uses' => 'Estate\Company\CompanyAppController@restore',
            'as' => 'estate.rental.restore'
        ]);

        //Get Destroy App Feature
        Route::get('destroy/{id}', [
            'uses' => 'Estate\Company\CompanyAppController@destroy',
            'as' => 'estate.rental.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Notification Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'notifications'], function () {

        //notifications
        Route::get('index/{id}', [
            'uses' => 'Estate\NotificationController@index',
            'as' => 'estate.rental.notifications'
        ]);

        //Toggle Notification As Read
        Route::get('notification/toggle/read/{id}', [
            'uses' => 'Estate\NotificationController@toggleRead',
            'as' => 'estate.rental.notification.read'
        ]);

        //Delete Notification
        Route::get('notification/delete/{id}', [
            'uses' => 'Estate\NotificationController@delete',
            'as' => 'estate.rental.notification.delete'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Subscription Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'subscription'], function () {

        //Trial Subscription Activation Route
        Route::get('trial/activation/{id}', [
            'uses' => 'Estate\Rental\Subscription\TrialController@store',
            'as' => 'estate.trial.activate'
        ]);

        //Trial Subscription Activation Route
        Route::get('trial/update/{id}/{subscription}', [
            'uses' => 'Estate\Rental\Subscription\TrialController@update',
            'as' => 'estate.trial.update'
        ]);

        //Create Subscription Route
        Route::get('create/{id}', [
            'uses' => 'Estate\PaypalSubscriptionController@create',
            'as' => 'estate.subscription.add'
        ]);

        //Retrieve Passed Subscription Plan Route
        Route::post('retrieve/plan', [
            'uses' => 'Estate\PaypalSubscriptionController@plan',
            'as' => 'estate.subscribe.plan'
        ]);

        //Store Subscription Route
        Route::post('paypal/add', [
            'uses' => 'Estate\PaypalSubscriptionController@store',
            'as' => 'estate.subscribe.paypal.store'
        ]);

        //Redirect Subscription Route
        Route::get('paypal/pay', [
            'uses' => 'Estate\PaypalSubscriptionController@pay',
            'as' => 'estate.subscribe.paypal.pay'
        ]);

        //Complete Subscription Route
        Route::get('paypal/complete/{id}', [
            'uses' => 'Estate\PaypalSubscriptionController@complete',
            'as' => 'estate.subscribe.paypal.complete'
        ]);

        //Error Subscription Route
        Route::get('paypal/error', [
            'uses' => 'Estate\PaypalSubscriptionController@error',
            'as' => 'estate.subscribe.paypal.error'
        ]);

        //Cancelled Subscription Route
        Route::get('paypal/cancel/{id}', [
            'uses' => 'Estate\PaypalSubscriptionController@cancel',
            'as' => 'estate.subscribe.paypal.cancel'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Amenities Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'amenities'], function () {

        //Get Amenities Route
        Route::get('index/{id}', [
            'uses' => 'Estate\AmenityController@index',
            'as' => 'estate.rental.amenities'
        ]);

        //Create Amenity Route
        Route::get('amenity/create/{id}', [
            'uses' => 'Estate\AmenityController@create',
            'as' => 'estate.rental.amenity.create'
        ]);

        //Edit Amenity Route
        Route::get('amenity/{id}', [
            'uses' => 'Estate\AmenityController@edit',
            'as' => 'estate.rental.amenity.edit'
        ]);

        //Post Add Amenity Route
        Route::post('amenity/add', [
            'uses' => 'Estate\AmenityController@store',
            'as' => 'estate.rental.amenity.store'
        ]);

        //Post Update Amenity Route
        Route::post('amenity/update', [
            'uses' => 'Estate\AmenityController@update',
            'as' => 'estate.rental.amenity.update'
        ]);

        //Get Update Amenity Status Route
        Route::get('amenity/status/{id}', [
            'uses' => 'Estate\AmenityController@toggleStatus',
            'as' => 'estate.rental.amenity.status'
        ]);

        //Get Delete Amenity Route
        Route::get('amenity/delete/{id}', [
            'uses' => 'Estate\AmenityController@delete',
            'as' => 'estate.rental.amenity.delete'
        ]);

        //Get Restore Amenity Route
        Route::get('amenity/restore/{id}', [
            'uses' => 'Estate\AmenityController@restore',
            'as' => 'estate.rental.amenity.restore'
        ]);

        //Get Destroy Amenity Route
        Route::get('amenity/destroy/{id}', [
            'uses' => 'Estate\AmenityController@destroy',
            'as' => 'estate.rental.amenity.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Company Group Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'groups'], function () {
        //Add Group Route
        Route::get('group/add-estate-group/{id}', [
            'uses' => 'Estate\GroupController@create',
            'as' => 'estate.rental.group.add'
        ]);

        //Get Groups Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\GroupController@index',
            'as' => 'estate.rental.groups.index'
        ]);

        //Get Group Route
        Route::get('group/{id}', [
            'uses' => 'Estate\GroupController@edit',
            'as' => 'estate.rental.group.edit'
        ]);

        //Post Add Group Route
        Route::post('group/add', [
            'uses' => 'Estate\GroupController@store',
            'as' => 'estate.rental.group.store'
        ]);

        //Post Update Group Route
        Route::post('group/update', [
            'uses' => 'Estate\GroupController@update',
            'as' => 'estate.rental.group.update'
        ]);

        //Get Update Group Status Route
        Route::get('group/status/{id}', [
            'uses' => 'Estate\GroupController@toggleStatus',
            'as' => 'estate.rental.group.status'
        ]);

        //Get Delete Group Route
        Route::get('group/delete/{id}', [
            'uses' => 'Estate\GroupController@delete',
            'as' => 'estate.rental.group.delete'
        ]);

        //Get Restore Group Route
        Route::get('group/restore/{id}', [
            'uses' => 'Estate\GroupController@restore',
            'as' => 'estate.rental.group.restore'
        ]);

        //Get Destroy Group Route
        Route::get('group/destroy/{id}', [
            'uses' => 'Estate\GroupController@destroy',
            'as' => 'estate.rental.group.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Company Properties Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'properties'], function () {

        //Add Property Route
        Route::get('property/create/{id}', [
            'uses' => 'Estate\Rental\Property\PropertyController@create',
            'as' => 'estate.rental.property.add'
        ]);

        //Get Properties Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\Rental\Property\PropertyController@index',
            'as' => 'estate.rental.properties'
        ]);

        //Get Property Route
        Route::get('property/{id}/edit', [
            'uses' => 'Estate\Rental\Property\PropertyController@edit',
            'as' => 'estate.rental.property.edit'
        ]);

        //Post Add Property Route
        Route::post('property/store', [
            'uses' => 'Estate\Rental\Property\PropertyController@store',
            'as' => 'estate.rental.property.store'
        ]);

        //Post Update Property Route
        Route::put('property/update/{id}', [
            'uses' => 'Estate\Rental\Property\PropertyController@update',
            'as' => 'estate.rental.property.update'
        ]);

        //Get Update Property Status Route
        Route::get('property/status/{id}', [
            'uses' => 'Estate\PropertyController@toggleStatus',
            'as' => 'estate.rental.property.status'
        ]);

        //Get Delete Property Route
        Route::get('property/delete/{id}', [
            'uses' => 'Estate\Rental\Property\PropertyController@delete',
            'as' => 'estate.rental.property.delete'
        ]);

        //Get Restore Property Route
        Route::get('property/restore/{id}', [
            'uses' => 'Estate\Rental\Property\PropertyController@restore',
            'as' => 'estate.rental.property.restore'
        ]);

        //Get Destroy Property Route
        Route::get('property/destroy/{id}', [
            'uses' => 'Estate\Rental\Property\PropertyController@destroy',
            'as' => 'estate.rental.property.destroy'
        ]);

        //Property Features
        Route::group(['prefix' => 'features/property'], function () {

            //Get Property Features Route
            Route::get('index/{id}', [
                'uses' => 'Estate\PropertyController@features',
                'as' => 'estate.rental.property.features'
            ]);

            //Post Store Property Features Route
            Route::post('features/store', [
                'uses' => 'Estate\PropertyController@addFeatures',
                'as' => 'estate.rental.property.features.add'
            ]);

            //Post Update Property Features Route
            Route::post('feature/update', [
                'uses' => 'Estate\PropertyController@updateFeature',
                'as' => 'estate.rental.property.features.update'
            ]);

            //Update Property Feature Status Route
            Route::get('feature/status/{id}', [
                'uses' => 'Estate\PropertyController@toggleFeatureStatus',
                'as' => 'estate.rental.property.feature.status'
            ]);

            //Delete Property Feature Route
            Route::get('feature/delete/{id}', [
                'uses' => 'Estate\PropertyController@deleteFeature',
                'as' => 'estate.rental.property.feature.delete'
            ]);

        });

        //Property Amenities
        Route::group(['prefix' => 'amenities/property'], function () {

            //Get Property Amenities Route
            Route::get('index/{id}', [
                'uses' => 'Estate\PropertyController@amenities',
                'as' => 'estate.rental.property.amenities'
            ]);

            //Post Update Property Amenities Route
            Route::post('/update', [
                'uses' => 'Estate\PropertyController@updateAmenities',
                'as' => 'estate.rental.property.amenities.update'
            ]);
        });
    });

    /**
     * -----------------------------------------------------------------
     * Company Tenant Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'tenants'], function () {
        //Create Tenant Route
        Route::get('add-estate-tenant/{id}', [
            'uses' => 'Estate\TenantController@create',
            'as' => 'estate.rental.tenant.add'
        ]);

        //Get Group Property Route
        Route::post('group/properties', [
            'uses' => 'Estate\TenantController@groupProperties',
            'as' => 'estate.rental.tenant.group.properties'
        ]);

        //Get Tenants Route
        Route::get('index/{id}/{sort}/{leases?}', [
            'uses' => 'Estate\TenantController@index',
            'as' => 'estate.rental.tenants'
        ]);

        //Get Group Route
        Route::get('tenant/lease/{id}', [
            'uses' => 'Estate\TenantController@edit',
            'as' => 'estate.rental.lease.edit'
        ]);

        //Post Add Group Route
        Route::post('tenant/add', [
            'uses' => 'Estate\TenantController@store',
            'as' => 'estate.rental.tenant.store'
        ]);

        //Post Update Group Route
        Route::post('tenant/lease/update', [
            'uses' => 'Estate\TenantController@update',
            'as' => 'estate.rental.tenant.update'
        ]);

        //Get Update Tenant Lease Status Route
        Route::get('tenant/lease/status/{id}', [
            'uses' => 'Estate\TenantController@toggleStatus',
            'as' => 'estate.rental.lease.status'
        ]);

        //Get Delete Tenant Lease Route
        Route::get('tenant/lease/delete/{id}', [
            'uses' => 'Estate\TenantController@delete',
            'as' => 'estate.rental.lease.delete'
        ]);

        //Get Restore Tenant Lease Route
        Route::get('tenant/lease/restore/{id}', [
            'uses' => 'Estate\TenantController@restore',
            'as' => 'estate.rental.lease.restore'
        ]);

        //Get Destroy Tenant Lease Route
        Route::get('tenant/lease/destroy/{id}', [
            'uses' => 'Estate\TenantController@destroy',
            'as' => 'estate.rental.lease.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Company Billing Services Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'billing'], function () {

        //Add Bill Service Route
        Route::get('service/add-service/{id}', [
            'uses' => 'Estate\BillServiceController@create',
            'as' => 'estate.rental.bills.service.add'
        ]);

        //Edit Bill Service Route
        Route::get('service/edit-service/{id}', [
            'uses' => 'Estate\BillServiceController@edit',
            'as' => 'estate.rental.bills.service.edit'
        ]);

        //Bills Service Settings Route
        Route::get('services/{id}/{sort}', [
            'uses' => 'Estate\BillServiceController@index',
            'as' => 'estate.rental.bills.services'
        ]);

        //Post Add Bill Service Route
        Route::post('service/add', [
            'uses' => 'Estate\BillServiceController@store',
            'as' => 'estate.rental.bills.service.store'
        ]);

        //Post Update Bill Service Route
        Route::post('service/update', [
            'uses' => 'Estate\BillServiceController@update',
            'as' => 'estate.rental.bills.service.update'
        ]);

        //Update Bill Service Status Route
        Route::get('service/status/{id}', [
            'uses' => 'Estate\BillServiceController@toggleStatus',
            'as' => 'estate.rental.bills.service.status'
        ]);

        //Delete Bill Service Route
        Route::get('service/delete/{id}', [
            'uses' => 'Estate\BillServiceController@delete',
            'as' => 'estate.rental.bills.service.delete'
        ]);

        //Restore Bill Service Route
        Route::get('service/restore/{id}', [
            'uses' => 'Estate\BillServiceController@restore',
            'as' => 'estate.rental.bills.service.restore'
        ]);

        //Destroy Bill Service Route
        Route::get('service/destroy/{id}', [
            'uses' => 'Estate\BillServiceController@destroy',
            'as' => 'estate.rental.bills.service.destroy'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Company Bill Invoice Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'bills'], function () {
        //Generate Bill Route
        Route::get('generate/invoices/{id}', [
            'uses' => 'Estate\BillController@generateInvoices',
            'as' => 'estate.rental.bills.generate'
        ]);

        //Add Bill Route
        Route::get('create/bills/{id}', [
            'uses' => 'Estate\BillController@create',
            'as' => 'estate.rental.bill.add'
        ]);

        //Edit Bill Route
        Route::get('edit/bill/{id}', [
            'uses' => 'Estate\BillController@edit',
            'as' => 'estate.rental.bills.invoice.edit'
        ]);

        //Bills Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\BillController@index',
            'as' => 'estate.rental.bills.tenants'
        ]);

        //Bills To PDF Route
        Route::get('reports/{id}/{sort}', [
            'uses' => 'Estate\BillController@pdfReport',
            'as' => 'estate.rental.bills.report.pdf'
        ]);

        //Post Add Bill Service Route
        Route::post('invoice/add', [
            'uses' => 'Estate\BillController@store',
            'as' => 'estate.rental.bills.invoices.store'
        ]);

        //Post Update Bill Service Route
        Route::post('invoice/update', [
            'uses' => 'Estate\BillController@update',
            'as' => 'estate.rental.bills.invoice.update'
        ]);

        //Update Bill Invoice Status Route
        Route::get('status/bill/{id}', [
            'uses' => 'Estate\BillController@toggleStatus',
            'as' => 'estate.rental.bills.invoice.status'
        ]);

        //Delete Bill Invoice Route
        Route::get('delete/bill/{id?}', [
            'uses' => 'Estate\BillController@delete',
            'as' => 'estate.rental.bills.invoice.delete'
        ]);

        //Restore Bill Invoice Route
        Route::get('restore/bill/{id}', [
            'uses' => 'Estate\BillController@restore',
            'as' => 'estate.rental.bills.invoice.restore'
        ]);

        //Destroy Bill Invoice Route
        Route::get('destroy/bill/{id?}', [
            'uses' => 'Estate\BillController@destroy',
            'as' => 'estate.rental.bills.invoice.destroy'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Company Rent Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'rents'], function () {
        //Add Rent Route
        Route::get('rent/generate/invoice/{id}', [
            'uses' => 'Estate\RentController@create',
            'as' => 'estate.rental.rent.add'
        ]);

        //Add Rent Route
        Route::get('rent/create/{id}', [
            'uses' => 'Estate\RentController@invoice',
            'as' => 'estate.rental.rent.generate.invoice'
        ]);

        //Get Rent Group Properties Route
        Route::post('rent/properties', [
            'uses' => 'Estate\RentController@groupProperties',
            'as' => 'estate.rental.rent.group.properties'
        ]);

        //Get Rent Group Property Route
        Route::post('rent/property', [
            'uses' => 'Estate\RentController@groupProperty',
            'as' => 'estate.rental.rent.group.property'
        ]);

        //Edit Rent Route
        Route::get('edit/rent/{id}', [
            'uses' => 'Estate\RentController@edit',
            'as' => 'estate.rental.rent.edit'
        ]);

        //Get Rents Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\RentController@index',
            'as' => 'estate.rental.rents'
        ]);

        //Rents To PDF Route
        Route::get('reports/{id}/{sort}', [
            'uses' => 'Estate\RentController@pdfReport',
            'as' => 'estate.rental.rents.report.pdf'
        ]);

        //Post Add Rent Invoice Route
        Route::post('rent/add', [
            'uses' => 'Estate\RentController@store',
            'as' => 'estate.rental.rent.store'
        ]);

        //Post Update Rent Invoice Route
        Route::post('rent/update', [
            'uses' => 'Estate\RentController@update',
            'as' => 'estate.rental.rent.update'
        ]);

        //Update Rent Invoice Status Route
        Route::get('rent/status/{id}', [
            'uses' => 'Estate\RentController@toggleStatus',
            'as' => 'estate.rental.rent.status'
        ]);

        //Get Delete Rent Invoice Route
        Route::get('rent/delete/{id?}', [
            'uses' => 'Estate\RentController@delete',
            'as' => 'estate.rental.rent.delete'
        ]);

        //Get Restore Rent Invoice Route
        Route::get('rent/restore/{id}', [
            'uses' => 'Estate\RentController@restore',
            'as' => 'estate.rental.rent.restore'
        ]);

        //Get Destroy Rent Invoice Route
        Route::get('rent/destroy/{id?}', [
            'uses' => 'Estate\RentController@destroy',
            'as' => 'estate.rental.rent.destroy'
        ]);
    });
});

/**
 * -----------------------------------------------------------------
 * Tenant Routes Group
 * -----------------------------------------------------------------
 * Handles all tenant routes
 */
Route::group(['prefix' => 'tenant'], function () {

    //tenant dashboard
    Route::get('dashboard/{id}', [
        'uses' => 'Tenant\AdminController@dashboard',
        'as' => 'tenant.dashboard'
    ]);

    //tenant lease
    Route::get('lease/{id}', [
        'uses' => 'Tenant\LeaseController@lease',
        'as' => 'tenant.lease'
    ]);

    //tenant leases
    Route::get('leases/{id}', [
        'uses' => 'Tenant\LeaseController@index',
        'as' => 'tenant.leases'
    ]);

    /**
     * -----------------------------------------------------------------
     * Rent Routes Group
     * -----------------------------------------------------------------
     * Handles all tenant rents routes
     */
    Route::group(['prefix' => 'rents'], function () {

        //tenant rent index
        Route::get('index/{id}', [
            'uses' => 'Tenant\Rent\RentController@index',
            'as' => 'tenant.rents'
        ]);

        //tenant rent
        Route::get('rent/invoice/{id}', [
            'uses' => 'Tenant\Rent\RentController@show',
            'as' => 'tenant.rent'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Tenant Bills Routes Group
     * prefix: bills
     * -----------------------------------------------------------------
     * Handles all tenant rents routes
     */
    Route::group(['prefix' => 'bills'], function () {
        //tenant bills
        Route::get('index/{id}', [
            'uses' => 'Tenant\Bills\BillController@index',
            'as' => 'tenant.bills'
        ]);

        //tenant bill show
        Route::get('bill/{id}/show', [
            'uses' => 'Tenant\Bills\BillController@show',
            'as' => 'tenant.bill'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Handles bills downloads
     * prefix: downloads
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'downloads'], function () {

        //tenant bill invoice to pdf
        Route::get('/bill/invoice/{id}/pdf', [
            'uses' => 'Tenant\Bills\PdfController@download',
            'as' => 'tenant.bill.download.pdf'
        ]);

        //tenant rent invoice to pdf
        Route::get('/rent/invoice/{id}/pdf', [
            'uses' => 'Tenant\Rent\PdfController@download',
            'as' => 'tenant.rent.download.pdf'
        ]);

    });

    //tenant rent status
    Route::get('rent/status/{id}', [
        'uses' => 'Tenant\Rent\RentController@toggleStatus',
        'as' => 'tenant.rent.status'
    ]);
});

/**
 * -----------------------------------------------------------------
 * User Routes Group
 * -----------------------------------------------------------------
 * Handles all user routes
 */
Route::group(['prefix' => 'user'], function () {

    //Get User Dashboard
    Route::get('dashboard/{section?}', [
        'uses' => 'UserController@dashboard',
        'as' => 'user.dashboard',
    ]);

    //Get User notifications
    Route::get('notifications', [
        'uses' => 'User\NotificationController@index',
        'as' => 'user.notifications',
    ]);

    //Toggle User Notification As Read
    Route::get('notification/toggle/read/{id}', [
        'uses' => 'User\NotificationController@toggleRead',
        'as' => 'user.notification.read'
    ]);

    //Get User Profile
    Route::get('profile', [
        'uses' => 'UserController@profile',
        'as' => 'user.profile'
    ]);

    //Update User profile
    Route::post('profile-update', [
        'uses' => 'UserController@update',
        'as' => 'user.profile.update'
    ]);

    //User avatar Upload View
    Route::get('profile/avatar', [
        'uses' => 'User\AvatarController@avatar',
        'as' => 'user.avatar'
    ]);

    //Store User avatar
    Route::post('avatar/store', [
        'uses' => 'User\AvatarController@store',
        'as' => 'user.avatar.store'
    ]);

    //Update User avatar
    Route::get('avatar/update/{id}', [
        'uses' => 'User\AvatarController@update',
        'as' => 'user.avatar.update'
    ]);

    //Delete User Avatar
    Route::get('avatar/delete/{id}', [
        'uses' => 'User\AvatarController@delete',
        'as' => 'user.avatar.delete'
    ]);

    //Get User Settings
    Route::get('settings', [
        'uses' => 'UserController@settings',
        'as' => 'user.settings'
    ]);
});

/**
 * -----------------------------------------------------------------
 * Company Routes Group
 * -----------------------------------------------------------------
 * Handles all company routes
 */
Route::group(['prefix' => 'company'], function () {

    //Get Company Profile
    Route::get('profile/{id}/{section?}', [
        'uses' => 'Estate\CompanyController@profile',
        'as' => 'company.profile'
    ]);

    //Get Company Settings
    Route::get('settings/{id}', [
        'uses' => 'Estate\CompanyController@settings',
        'as' => 'company.settings'
    ]);

    Route::group(['prefix' => 'admin', 'middleware' => 'company.admin'], function () {
        /**
         * -----------------------------------------------------------------
         * Company Admin Routes
         * -----------------------------------------------------------------
         */
        //Post Update Company
        Route::post('update-company', [
            'uses' => 'Estate\CompanyController@update',
            'as' => 'company.update'
        ]);

        //Store Company Logo
        Route::post('logo-store', [
            'uses' => 'Estate\CompanyController@storeLogo',
            'as' => 'company.logo.store'
        ]);

        //Change Company Logo
        Route::get('logo-change/{id}', [
            'uses' => 'Estate\CompanyController@changeLogo',
            'as' => 'company.logo.change'
        ]);

        //Delete Company Logo
        Route::get('logo-delete/{id}', [
            'uses' => 'Estate\CompanyController@deleteLogo',
            'as' => 'company.logo.delete'
        ]);

        //Post Update Company Status
        Route::get('status/{id}', [
            'uses' => 'Estate\CompanyController@toggleStatus',
            'as' => 'company.status'
        ]);

        //Get Delete Company Feature
        Route::get('delete/{id}', [
            'uses' => 'Estate\CompanyController@delete',
            'as' => 'company.delete'
        ]);

        //Get Restore Company Feature
        Route::get('restore/{id}', [
            'uses' => 'Estate\CompanyController@restore',
            'as' => 'company.restore'
        ]);

        //Get Destroy App Feature
        Route::get('destroy/{id}', [
            'uses' => 'Estate\CompanyController@destroy',
            'as' => 'company.destroy'
        ]);
    });
});

/**
 * -----------------------------------------------------------------
 * App Create Routes Group
 * -----------------------------------------------------------------
 * Handles all user app routes
 */
Route::group(['prefix' => 'app'], function () {

    //Get Create App
    Route::get('create/{app}', [
        'uses' => 'Estate\CompanyController@create',
        'as' => 'app.create'
    ]);

    //Post Add App
    Route::post('add-app', [
        'uses' => 'Estate\CompanyController@store',
        'as' => 'app.store'
    ]);

    /**
     * -----------------------------------------------------------------
     * App Admin Routes
     * -----------------------------------------------------------------
     */
//    Route::group(['prefix' => 'admin', 'middleware' => 'company.app.admin'], function () {
//
//        /**
//         * -----------------------------------------------------------------
//         * App Admin Routes
//         * -----------------------------------------------------------------
//         */
//        //Post Update App
//        Route::post('update-app', [
//            'uses' => 'Estate\AdminController@update',
//            'as' => 'app.update'
//        ]);
//
//        //Post Update App Status
//        Route::get('status/{id}', [
//            'uses' => 'Estate\AdminController@toggleStatus',
//            'as' => 'app.status'
//        ]);
//
//        //Get Delete App Feature
//        Route::get('delete/{id}', [
//            'uses' => 'Estate\AdminController@delete',
//            'as' => 'app.delete'
//        ]);
//
//        //Get Restore App Feature
//        Route::get('restore/{id}', [
//            'uses' => 'Estate\AdminController@restore',
//            'as' => 'app.restore'
//        ]);
//
//        //Get Destroy App Feature
//        Route::get('destroy/{id}', [
//            'uses' => 'Estate\AdminController@destroy',
//            'as' => 'app.destroy'
//        ]);
//    });

});

/**
 * -----------------------------------------------------------------
 * Overriden Auth Routes
 * -----------------------------------------------------------------
 */
Auth::routes();

// Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@postLogin']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@getSignUp']);
Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@postSignUp']);

// Password Reset Routes...
Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@getResetForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);

//Registration activation routes
Route::get('activation/key/{activation_key}', ['as' => 'activation_key', 'uses' => 'Auth\ActivationController@activateKey']);
Route::get('activation/resend', ['as' => 'activation.key.resend', 'uses' => 'Auth\ActivationController@showKeyResendForm']);
Route::post('activation/resend', ['as' => 'activation.key.resend.post', 'uses' => 'Auth\ActivationController@resendKey']);
