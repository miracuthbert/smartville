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

//Apps Route
Route::get('/apps', [
    'uses' => 'HomeController@services',
    'as' => 'services'
]);

//App Show Route
Route::get('/apps/{id}/show', [
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

//Contact Post Route
Route::post('/contact', [
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

    /**
     * -----------------------------------------------------------------
     * Contact  Routes
     * -----------------------------------------------------------------
     */

    Route::group(['prefix' => 'contact/messages'], function () {
        //toggle message read_at status
        Route::get('toggle_read/{message?}', [
            'uses' => 'Admin\Contact\ToggleReadController',
            'as' => 'admin.contact.message.toggle_read',
        ]);
    });

    //contact messages
    Route::resource('contact/messages', 'Admin\Contact\ContactController', [
        'except' => [
            'destroy',
        ],
        'names' => [
            'index' => 'admin.contact.messages',
            'store' => 'admin.contact.message.store',
            'show' => 'admin.contact.message',
        ]
    ]);

    /**
     * -----------------------------------------------------------------
     * Category Routes
     * -----------------------------------------------------------------
     */
    //destroy category route
    Route::get('category/destroy/{category}', [
        'uses' => 'Admin\Category\CategoryController@destroy',
        'as' => 'category.destroy',
    ]);

    //generate category slug route
    Route::get('category/slugs/generate', [
        'uses' => 'Admin\Category\CategoryController@auto_slug',
        'as' => 'category.slugs',
    ]);

    Route::resource('category', 'Admin\Category\CategoryController', ['except' => [
        'destroy',
    ]]);

    /**
     * -----------------------------------------------------------------
     * Company & Company Apps Routes
     * -----------------------------------------------------------------
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
     * -----------------------------------------------------------------
     * Roles Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'roles'], function () {
        Route::get('roles/{role}/destroy', [
            'uses' => 'Admin\Role\RoleController@destroy',
            'as' => 'roles.destroy',
        ]);
    });

    Route::resource('roles', 'Admin\Role\RoleController', [
        'except' => [
            'destroy',
        ],
    ]);

    /**
     * -----------------------------------------------------------------
     * Users Routes
     * -----------------------------------------------------------------
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
     * -----------------------------------------------------------------
     * App Products Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'apps'], function () {
        //Get Admin Add Product
        Route::get('app/create', [
            'uses' => 'Admin\App\AppController@create',
            'as' => 'admin.app.create'
        ]);

        //Post Admin Add Product
        Route::post('/', [
            'uses' => 'Admin\App\AppController@store',
            'as' => 'admin.app.store'
        ]);

        //Get Admin Product
        Route::get('app/{id}', [
            'uses' => 'Admin\App\AppController@show',
            'as' => 'admin.app.view'
        ]);

        //Get Admin Product
        Route::get('app/{id}/edit', [
            'uses' => 'Admin\App\AppController@edit',
            'as' => 'admin.app.edit'
        ]);

        //Get Admin Update Product Status
        Route::get('status/{id}', [
            'uses' => 'Admin\App\AppController@status',
            'as' => 'admin.app.status'
        ]);

        //Post Admin Update Product
        Route::put('app/{id}', [
            'uses' => 'Admin\App\AppController@update',
            'as' => 'admin.app.update'
        ]);

        //Post Admin Delete Product
        Route::get('delete/{id}', [
            'uses' => 'Admin\App\AppController@delete',
            'as' => 'admin.app.delete'
        ]);

        //Post Admin Delete Product
        Route::get('destroy/{id}', [
            'uses' => 'Admin\App\AppController@destroy',
            'as' => 'admin.app.destroy'
        ]);

        //Post Admin Restore Product
        Route::get('restore/{id}', [
            'uses' => 'Admin\App\AppController@restore',
            'as' => 'admin.app.restore'
        ]);

        //Get Admin Products
        Route::get('/{sort}', [
            'uses' => 'Admin\App\AppController@index',
            'as' => 'admin.apps'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * App Features Routes
     * -----------------------------------------------------------------
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
     * Admin Support Bugs Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'bugs'], function () {
        //update bug status route
        Route::get('{bug}/status', [
            'uses' => 'Admin\Support\BugController@status',
            'as' => 'bugs.status'
        ]);
    });

    //Bugs Resource routes
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
Route::group(['prefix' => 'rental/{app}', 'namespace' => 'Rental'], function () {

    //dashboard
    Route::get('dashboard', [
        'uses' => 'App\DashboardController',
        'as' => 'rental.dashboard'
    ]);

    //profile
    Route::get('profile', [
        'uses' => 'App\ProfileController',
        'as' => 'rental.profile'
    ]);

    /**
     * -----------------------------------------------------------------
     * App Settings Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'settings', 'namespace' => 'App'], function () {
        //settings
        Route::get('/', [
            'uses' => 'SettingsController@index',
            'as' => 'rental.settings'
        ]);

        //settings
        Route::post('/update', [
            'uses' => 'SettingsController@update',
            'as' => 'rental.settings.update'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Notification Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'notifications', 'namespace' => 'Notification'], function () {

        //notifications
        Route::get('/', [
            'uses' => 'NotificationController@index',
            'as' => 'rental.notifications.index'
        ]);

        //Toggle Notification As Read
        Route::get('/{id}/read', [
            'uses' => 'NotificationController@toggleRead',
            'as' => 'rental.notifications.read'
        ]);

        //Toggle Notification As Read
        Route::put('/read/all', [
            'uses' => 'NotificationController@update',
            'as' => 'rental.notifications.update'
        ]);

        //Delete All Notifications
        Route::delete('/destroy', [
            'uses' => 'NotificationController@destroy',
            'as' => 'rental.notifications.destroy'
        ]);

        //Delete Notification
        Route::delete('{id}/delete', [
            'uses' => 'NotificationController@delete',
            'as' => 'rental.notifications.delete'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Subscription Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'subscription', 'namespace' => 'Subscription'], function () {

        //Trial Subscription Activation Route
        Route::get('trial/activation/', [
            'uses' => 'TrialController@store',
            'as' => 'estate.trial.activate'
        ]);

        //Trial Subscription Activation Route
        Route::put('trial/update/{id}/{subscription}', [
            'uses' => 'TrialController@update',
            'as' => 'estate.trial.update'
        ]);

        //Create Subscription Route
        Route::get('create', [
            'uses' => 'PaypalSubscriptionController@create',
            'as' => 'estate.subscription.add'
        ]);

        //Retrieve Passed Subscription Plan Route
        Route::post('retrieve/plan', [
            'uses' => 'PaypalSubscriptionController@plan',
            'as' => 'estate.subscribe.plan'
        ]);

        //Store Subscription Route
        Route::post('paypal/add', [
            'uses' => 'PaypalSubscriptionController@store',
            'as' => 'estate.subscribe.paypal.store'
        ]);

        //Redirect Subscription Route
        Route::get('paypal/pay', [
            'uses' => 'PaypalSubscriptionController@pay',
            'as' => 'estate.subscribe.paypal.pay'
        ]);

        //Complete Subscription Route
        Route::get('paypal/complete/{id}', [
            'uses' => 'PaypalSubscriptionController@complete',
            'as' => 'estate.subscribe.paypal.complete'
        ]);

        //Error Subscription Route
        Route::get('paypal/error', [
            'uses' => 'PaypalSubscriptionController@error',
            'as' => 'estate.subscribe.paypal.error'
        ]);

        //Cancelled Subscription Route
        Route::get('paypal/cancel/{id}', [
            'uses' => 'PaypalSubscriptionController@cancel',
            'as' => 'estate.subscribe.paypal.cancel'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Amenities Group Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'amenities', 'namespace' => 'Amenity'], function () {

        //Get Update Amenity Status Route
        Route::get('/{amenity}/status', [
            'uses' => 'AmenityController@toggleStatus',
            'as' => 'rental.amenities.status'
        ]);

        //Get Delete Amenity Route
        Route::delete('/{amenity}/delete', [
            'uses' => 'AmenityController@delete',
            'as' => 'rental.amenities.delete'
        ]);

        //Get Restore Amenity Route
        Route::get('/{amenity}/restore', [
            'uses' => 'AmenityController@restore',
            'as' => 'rental.amenities.restore'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Amenities Resource Routes
     * -----------------------------------------------------------------
     */
    Route::resource('amenities', 'Amenity\AmenityController', [
        'names' => [
            'index' => 'rental.amenities.index',
            'create' => 'rental.amenities.create',
            'store' => 'rental.amenities.store',
            'show' => 'rental.amenities.show',
            'edit' => 'rental.amenities.edit',
            'update' => 'rental.amenities.update',
            'destroy' => 'rental.amenities.destroy',
        ],
    ]);


    /**
     * -----------------------------------------------------------------
     * Company Properties Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'properties', 'namespace' => 'Property'], function () {

        /**
         * -----------------------------------------------------------------
         * Property Groups Group Routes
         * -----------------------------------------------------------------
         */
        Route::group(['prefix' => 'groups'], function () {
            //old Estate/GroupController

            //Get Update Group Status Route
            Route::put('/{group}/status', [
                'uses' => 'PropertyGroupController@toggleStatus',
                'as' => 'rental.properties.groups.status'
            ]);

            //Get Delete Group Route
            Route::delete('/{group}/delete', [
                'uses' => 'PropertyGroupController@delete',
                'as' => 'rental.properties.groups.delete'
            ]);

            //Get Restore Group Route
            Route::put('/{group}/restore', [
                'uses' => 'PropertyGroupController@restore',
                'as' => 'rental.properties.groups.restore'
            ]);
        });

        /**
         * -----------------------------------------------------------------
         * Property Groups Resource Routes
         * -----------------------------------------------------------------
         */
        Route::resource('groups', 'PropertyGroupController', [
            'names' => [
                'index' => 'rental.properties.groups.index',
                'create' => 'rental.properties.groups.create',
                'store' => 'rental.properties.groups.store',
                'show' => 'rental.properties.groups.show',
                'edit' => 'rental.properties.groups.edit',
                'update' => 'rental.properties.groups.update',
                'destroy' => 'rental.properties.groups.destroy',
            ],
        ]);

        /**
         * -----------------------------------------------------------------
         * Property Routes Group
         * -----------------------------------------------------------------
         */
        Route::group(['prefix' => '/{property}'], function () {
            //Update Property Status Route
            Route::put('/status', [
                'uses' => 'PropertyController@toggleStatus',
                'as' => 'rental.properties.status'
            ]);

            //Delete Property Route
            Route::delete('/delete', [
                'uses' => 'PropertyController@delete',
                'as' => 'rental.properties.delete'
            ]);

            //Restore Property Route
            Route::put('/restore', [
                'uses' => 'PropertyController@restore',
                'as' => 'rental.properties.restore'
            ]);

            //Destroy Property Route
            Route::delete('/destroy', [
                'uses' => 'PropertyController@destroy',
                'as' => 'rental.properties.destroy'
            ]);

            /**
             * -----------------------------------------------------------------
             * Property Amenities Resource Routes
             * -----------------------------------------------------------------
             */
            Route::post('/', 'PropertyAmenityController@store')->name('rental.properties.amenities.store');
            
            Route::resource('amenities', 'PropertyAmenityController', [
                'except' => ['create', 'store', 'show', 'edit', 'update'],
                'names' => [
                    'index' => 'rental.properties.amenities.index',
                    'destroy' => 'rental.properties.amenities.destroy',
                ],
            ]);


            /**
             * -----------------------------------------------------------------
             * Property Features Routes
             * -----------------------------------------------------------------
             */
            Route::group(['prefix' => 'features'], function () {
                //old: Estate\PropertyController

                //Update Property Feature Status Route
                Route::put('/{feature}/status', [
                    'uses' => 'PropertyFeatureController@toggleFeatureStatus',
                    'as' => 'rental.properties.features.status'
                ]);

                //Restore Property Feature Route
                Route::put('/{feature}/restore/', [
                    'uses' => 'PropertyFeatureController@restore',
                    'as' => 'rental.properties.features.restore'
                ]);

                //Delete Property Feature Route
                Route::delete('/{feature}/delete/', [
                    'uses' => 'PropertyFeatureController@delete',
                    'as' => 'rental.properties.features.delete'
                ]);

            });

            Route::resource('features', 'PropertyFeatureController', [
                'except' => ['create', 'show', 'edit'],
                'names' => [
                    'index' => 'rental.properties.features.index',
                    'store' => 'rental.properties.features.store',
                    'update' => 'rental.properties.features.update',
                    'destroy' => 'rental.properties.features.destroy',
                ],
            ]);
        }); //end of property routes group
    });

    /**
     * -----------------------------------------------------------------
     * Properties Resource Routes
     * -----------------------------------------------------------------
     */
    Route::resource('properties', 'Property\PropertyController', [
        'names' => [
            'index' => 'rental.properties.index',
            'create' => 'rental.properties.create',
            'store' => 'rental.properties.store',
            'show' => 'rental.properties.show',
            'edit' => 'rental.properties.edit',
            'update' => 'rental.properties.update',
            'destroy' => 'rental.properties.destroy',
        ],
    ]);

    /**
     * -----------------------------------------------------------------
     * Property Galleries Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'property/galleries', 'namespace' => 'Property'], function () {

        //Create Property Gallery Route
        Route::get('create/{id}', [
            'uses' => 'GalleryController@create',
            'as' => 'rental.properties.gallery.create'
        ]);

        //Get Property Gallery Route
        Route::get('index/{id}/{sort?}', [
            'uses' => 'GalleryController@index',
            'as' => 'rental.properties.gallery.index'
        ]);

        //Edit Property Gallery Route
        Route::get('edit/{id}', [
            'uses' => 'GalleryController@edit',
            'as' => 'rental.properties.gallery.edit'
        ]);

        //Show Property Gallery Route
        Route::get('show/{id}', [
            'uses' => 'GalleryController@show',
            'as' => 'rental.properties.gallery.show'
        ]);

        //Store Property Gallery Route
        Route::post('store', [
            'uses' => 'GalleryController@store',
            'as' => 'rental.properties.gallery.store'
        ]);

        //Update Property Gallery Route
        Route::put('update/{id}', [
            'uses' => 'GalleryController@update',
            'as' => 'rental.properties.gallery.update'
        ]);

        //Update Property Gallery Status Route
        Route::get('status/{id}', [
            'uses' => 'GalleryController@toggleStatus',
            'as' => 'rental.properties.gallery.status'
        ]);

        //Delete Property Gallery Route
        Route::get('delete/{id}', [
            'uses' => 'GalleryController@delete',
            'as' => 'rental.properties.gallery.delete'
        ]);

        //Restore Property Gallery Route
        Route::get('restore/{id}', [
            'uses' => 'GalleryController@restore',
            'as' => 'rental.properties.gallery.restore'
        ]);

        //Destroy Property Gallery Route
        Route::get('destroy/{id}', [
            'uses' => 'GalleryController@destroy',
            'as' => 'rental.properties.gallery.destroy'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Property Images Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'property/images', 'namespace' => 'Property'], function () {

        //Create Property Image Route
        Route::get('create/{id}', [
            'uses' => 'PhotoController@create',
            'as' => 'rental.properties.image.create'
        ]);

        //Get Property Image Route
        Route::get('index/{id}/{sort?}', [
            'uses' => 'PhotoController@index',
            'as' => 'rental.properties.image.index'
        ]);

        //Edit Property Image Route
        Route::get('edit/{id}', [
            'uses' => 'PhotoController@edit',
            'as' => 'rental.properties.image.edit'
        ]);

        //Store Property Image Route
        Route::post('store', [
            'uses' => 'PhotoController@store',
            'as' => 'rental.properties.image.store'
        ]);

        //Update Property Image Route
        Route::put('update/{id}', [
            'uses' => 'PhotoController@update',
            'as' => 'rental.properties.image.update'
        ]);

        //Update Property Image Status Route
        Route::get('status/{id}', [
            'uses' => 'PhotoController@toggleStatus',
            'as' => 'rental.properties.image.status'
        ]);

        //Delete Property Image Route
        Route::get('delete/{id}', [
            'uses' => 'PhotoController@delete',
            'as' => 'rental.properties.image.delete'
        ]);

        //Restore Property Image Route
        Route::get('restore/{id}', [
            'uses' => 'PhotoController@restore',
            'as' => 'rental.properties.image.restore'
        ]);

        //Destroy Property Image Route
        Route::get('destroy/{id}', [
            'uses' => 'PhotoController@destroy',
            'as' => 'rental.properties.image.destroy'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Company Tenant Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'tenants', 'namespace' => 'Tenant'], function () {
        //old: Estate\TenantController
        //Create Tenant Route
        Route::get('/create', [
            'uses' => 'TenantController@create',
            'as' => 'rental.tenant.create'
        ]);

        //Get Group Property Route
        Route::post('group/properties', [
            'uses' => 'TenantController@groupProperties',
            'as' => 'rental.tenant.group.properties'
        ]);

        //Get Tenants Route
        Route::get('/{sort}/{leases?}', [
            'uses' => 'TenantController@index',
            'as' => 'rental.tenants.index'
        ]);

        //Get Group Route
        Route::get('tenant/lease/{id}', [
            'uses' => 'TenantController@edit',
            'as' => 'rental.lease.edit'
        ]);

        //Post Create Group Route
        Route::post('/', [
            'uses' => 'TenantController@store',
            'as' => 'rental.tenant.store'
        ]);

        //Post Update Group Route
        Route::put('/update/{id}', [
            'uses' => 'TenantController@update',
            'as' => 'rental.tenant.update'
        ]);

        //Get Update Tenant Lease Status Route
        Route::get('/{id}/status', [
            'uses' => 'TenantController@toggleStatus',
            'as' => 'rental.lease.status'
        ]);

        //Get Delete Tenant Lease Route
        Route::delete('/{id}/delete', [
            'uses' => 'TenantController@delete',
            'as' => 'rental.lease.delete'
        ]);

        //Get Restore Tenant Lease Route
        Route::get('/{id}/restore', [
            'uses' => 'TenantController@restore',
            'as' => 'rental.lease.restore'
        ]);

        //Get Destroy Tenant Lease Route
        Route::delete('/{id}/destroy', [
            'uses' => 'TenantController@destroy',
            'as' => 'rental.lease.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Company Bill Invoice Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'bills', 'namespace' => 'Bill'], function () {

        /**
         * -----------------------------------------------------------------
         * Company Billing Services Routes
         * -----------------------------------------------------------------
         */
        Route::group(['prefix' => 'services'], function () {
            //old: Estate\BillServiceController

            //Update Bill Service Status Route
            Route::put('/{service}/status', [
                'uses' => 'BillServiceController@toggleStatus',
                'as' => 'rental.bills.services.status'
            ]);

            //Delete Bill Service Route
            Route::delete('/{service}/delete', [
                'uses' => 'BillServiceController@delete',
                'as' => 'rental.bills.services.delete'
            ]);

            //Restore Bill Service Route
            Route::put('/{service}/restore', [
                'uses' => 'BillServiceController@restore',
                'as' => 'rental.bills.services.restore'
            ]);

        });

        /**
         * -----------------------------------------------------------------
         * Bill Services Resource Routes
         * -----------------------------------------------------------------
         */
        Route::resource('services', 'BillServiceController', [
            'names' => [
                'index' => 'rental.bills.services.index',
                'create' => 'rental.bills.services.create',
                'store' => 'rental.bills.services.store',
                'show' => 'rental.bills.services.show',
                'edit' => 'rental.bills.services.edit',
                'update' => 'rental.bills.services.update',
                'destroy' => 'rental.bills.services.destroy',
            ],
        ]);

        //Generate Bill Route
        Route::get('generate/invoices', [
            'uses' => 'BillController@generateInvoices',
            'as' => 'rental.bills.generate'
        ]);

        //Add Bill Route
        Route::get('/create', [
            'uses' => 'BillController@create',
            'as' => 'rental.bills.create'
        ]);

        //Edit Bill Route
        Route::get('/{id}/edit', [
            'uses' => 'BillController@edit',
            'as' => 'rental.bills.invoice.edit'
        ]);

        //Bills Route
        Route::get('/{sort}', [
            'uses' => 'BillController@index',
            'as' => 'rental.bills.index'
        ]);

        //Bills To PDF Route
        Route::get('reports/{sort}', [
            'uses' => 'BillController@pdfReport',
            'as' => 'rental.bills.report.pdf'
        ]);

        //Post Add Bill Service Route
        Route::post('/', [
            'uses' => 'BillController@store',
            'as' => 'rental.bills.store'
        ]);

        //Post Update Bill Service Route
        Route::put('/update/{id}', [
            'uses' => 'BillController@update',
            'as' => 'rental.bills.update'
        ]);

        //Update Bill Invoice Status Route
        Route::get('/{id/status}', [
            'uses' => 'BillController@toggleStatus',
            'as' => 'rental.bills.status'
        ]);

        //Delete Bill Invoice Route
        Route::delete('delete/bill/{id?}', [
            'uses' => 'BillController@delete',
            'as' => 'rental.bills.delete'
        ]);

        //Restore Bill Invoice Route
        Route::get('/{id}/restore', [
            'uses' => 'BillController@restore',
            'as' => 'rental.bills.restore'
        ]);

        //Destroy Bill Invoice Route
        Route::get('destroy/bill/{id?}', [
            'uses' => 'BillController@destroy',
            'as' => 'rental.bills.destroy'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Company Rent Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'rents', 'namespace' => 'Rent'], function () {
        //old: Estate\RentController
        //Add Rent Route
        Route::get('generate/invoice', [
            'uses' => 'RentController@invoice',
            'as' => 'rental.rents.create'
        ]);

        //Add Rent Route
        Route::get('create', [
            'uses' => 'RentController@create',
            'as' => 'rental.rents.generate.invoice'
        ]);

        //Get Rent Group Properties Route
        Route::post('rent/properties', [
            'uses' => 'RentController@groupProperties',
            'as' => 'rental.rents.group.properties'
        ]);

        //Get Rent Group Property Route
        Route::post('rent/property', [
            'uses' => 'RentController@groupProperty',
            'as' => 'rental.rents.group.property'
        ]);

        //Edit Rent Route
        Route::get('edit/{id}', [
            'uses' => 'RentController@edit',
            'as' => 'rental.rents.edit'
        ]);

        //Get Rents Route
        Route::get('/{sort?}', [
            'uses' => 'RentController@index',
            'as' => 'rental.rents.index'
        ]);

        //Rents To PDF Route
        Route::get('reports/{id}/{sort}', [
            'uses' => 'RentController@pdfReport',
            'as' => 'rental.rents.report.pdf'
        ]);

        //Post Add Rent Invoice Route
        Route::post('/', [
            'uses' => 'RentController@store',
            'as' => 'rental.rents.store'
        ]);

        //Post Update Rent Invoice Route
        Route::put('update/{id}', [
            'uses' => 'RentController@update',
            'as' => 'rental.rents.update'
        ]);

        //Update Rent Invoice Status Route
        Route::get('/{id}/status', [
            'uses' => 'RentController@toggleStatus',
            'as' => 'rental.rents.status'
        ]);

        //Get Delete Rent Invoice Route
        Route::delete('/delete/{id?}', [
            'uses' => 'RentController@delete',
            'as' => 'rental.rents.delete'
        ]);

        //Get Restore Rent Invoice Route
        Route::get('rent/restore/{id}', [
            'uses' => 'RentController@restore',
            'as' => 'rental.rents.restore'
        ]);

        //Get Destroy Rent Invoice Route
        Route::delete('/destroy/{id?}', [
            'uses' => 'RentController@destroy',
            'as' => 'rental.rents.destroy'
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
 * Handles Hostel App Routes
 *
 * Hostel App Routes Group
 * -----------------------------------------------------------------
 */
Route::group(['prefix' => 'hostel'], function () {

    //Dashboard Route
    Route::get('/dashboard/{id}', [
        'uses' => 'Hostel\DashboardController',
        'as' => 'hostel.dashboard',
    ]);

    /**
     * -----------------------------------------------------------------
     * Handles custom routes for amenities
     *
     * Property Group Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'amenities/{app}'], function () {

        //Index Route
        Route::get('/', [
            'uses' => 'Hostel\Amenity\AmenityController@index',
            'as' => 'hostel.amenity.index',
        ]);

        /**
         * -----------------------------------------------------------------
         * Handles resource routes for amenities
         *
         * Property Resource Routes
         * -----------------------------------------------------------------
         */
        Route::resource('amenity', 'Hostel\Amenity\AmenityController', [
            'except' => ['index', 'destroy'],
            'names' => [
                'create' => 'hostel.amenity.create',
                'store' => 'hostel.amenity.store',
                'show' => 'hostel.amenity.show',
                'edit' => 'hostel.amenity.edit',
                'update' => 'hostel.amenity.update',
            ],
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Handles custom routes for properties
     *
     * Property Group Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'properties/{app}'], function () {

        //Index Route
        Route::get('/', [
            'uses' => 'Hostel\Property\PropertyController@index',
            'as' => 'hostel.property.index',
        ]);

        /**
         * -----------------------------------------------------------------
         * Handles resource routes for properties
         *
         * Property Resource Routes
         * -----------------------------------------------------------------
         */
        Route::resource('property', 'Hostel\Property\PropertyController', [
            'except' => ['index', 'destroy'],
            'names' => [
                'create' => 'hostel.property.create',
                'store' => 'hostel.property.store',
                'show' => 'hostel.property.show',
                'edit' => 'hostel.property.edit',
                'update' => 'hostel.property.update',
            ],
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Handles custom routes for tenants
     *
     * Tenants Group Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'tenants/{app}'], function () {

        //Index Route
        Route::get('/', [
            'uses' => 'Hostel\Tenant\TenantController@index',
            'as' => 'hostel.tenant.index',
        ]);

        /**
         * -----------------------------------------------------------------
         * Handles resource routes for properties
         *
         * Property Resource Routes
         * -----------------------------------------------------------------
         */
        Route::resource('tenant', 'Hostel\Tenant\TenantController', [
            'except' => ['index', 'destroy'],
            'names' => [
                'create' => 'hostel.tenant.create',
                'store' => 'hostel.tenant.store',
                'show' => 'hostel.tenant.show',
                'edit' => 'hostel.tenant.edit',
                'update' => 'hostel.tenant.update',
            ],
        ]);
    });

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

    /**
     * -----------------------------------------------------------------
     * Company Admin Group Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'company.admin'], function () {
        /**
         * -----------------------------------------------------------------
         * Company Admin Routes
         * -----------------------------------------------------------------
         */
        //Post Update Company
        Route::post('/update', [
            'uses' => 'Estate\CompanyController@update',
            'as' => 'company.update'
        ]);

        //Store Company Logo
        Route::post('logo/store', [
            'uses' => 'Estate\CompanyController@storeLogo',
            'as' => 'company.logo.store'
        ]);

        //Change Company Logo
        Route::get('logo/{id}', [
            'uses' => 'Estate\CompanyController@changeLogo',
            'as' => 'company.logo.change'
        ]);

        //Delete Company Logo
        Route::get('logo/delete/{id}', [
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

    /**
     * -----------------------------------------------------------------
     * Company App Admin Group Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => '/app/admin', 'namespace' => 'Company'], function () {

        //Post Update App
        Route::post('update/app', [
            'uses' => 'CompanyAppController@update',
            'as' => 'company.app.update'
        ]);

        //Post Update App Status
        Route::get('status/{id}', [
            'uses' => 'CompanyAppController@toggleStatus',
            'as' => 'company.app.status'
        ]);

        //Get Delete App Feature
        Route::get('delete/{id}', [
            'uses' => 'CompanyAppController@delete',
            'as' => 'company.app.delete'
        ]);

        //Get Restore App Feature
        Route::get('restore/{id}', [
            'uses' => 'CompanyAppController@restore',
            'as' => 'company.app.restore'
        ]);

        //Get Destroy App Feature
        Route::get('destroy/{id}', [
            'uses' => 'CompanyAppController@destroy',
            'as' => 'company.app.destroy'
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
    Route::post('/', [
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
 * Default Auth Routes
 * -----------------------------------------------------------------
 */
Auth::routes();

////Registration activation routes
Route::get('activation/key/{activation_key}', ['as' => 'activation_key', 'uses' => 'Auth\ActivationController@activateKey']);
Route::get('activation/resend', ['as' => 'activation.key.resend', 'uses' => 'Auth\ActivationController@showKeyResendForm']);
Route::post('activation/resend', ['as' => 'activation.key.resend.post', 'uses' => 'Auth\ActivationController@resendKey']);
