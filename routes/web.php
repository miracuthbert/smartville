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

/**
 * Support Resource Route
 */
Route::resource('support', 'Support\Test\SupportController');

/**
 * Questions Resource Route
 */
Route::resource('support/questions', 'Support\Test\TestQuestionController');

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
    Route::get('notifications', [
        'uses' => 'Admin\AdminController@notifications',
        'as' => 'admin.notifications'
    ]);

    //Mark Admin Notification As Read
    Route::get('notification/toggle/read/{id}', [
        'uses' => 'Admin\AdminController@notificationRead',
        'as' => 'admin.notification.read'
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

    Route::group(['prefix' => 'apps'], function () {
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
     * Admin App Plan Features
     */

    Route::group(['prefix' => 'app/plan/features'], function () {
        //Post Admin Add App Plan Features
        Route::post('add-features', [
            'uses' => 'Admin\PlanFeatureController@store',
            'as' => 'admin.plan.feature.store'
        ]);
    });

});

/**
 * -----------------------------------------------------------------
 * Estate App Routes Group
 * -----------------------------------------------------------------
 */
Route::group(['prefix' => 'estate'], function () {

    //dashboard
    Route::get('dashboard/{id}', [
        'uses' => 'Estate\AdminController@getDashboard',
        'as' => 'estate.dashboard'
    ]);

    //profile
    Route::get('profile/{id}', [
        'uses' => 'Estate\AdminController@getProfile',
        'as' => 'estate.profile'
    ]);

    //settings
    Route::get('settings/{id}', [
        'uses' => 'Estate\AdminController@getSettings',
        'as' => 'estate.settings'
    ]);

    /**
     * -----------------------------------------------------------------
     * Notification Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'notifications'], function () {

        //notifications
        Route::get('index/{id}', [
            'uses' => 'Estate\NotificationController@index',
            'as' => 'estate.notifications'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Subscription Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'subscription'], function () {
        //Create Subscription Route
        Route::get('create/{id}', [
            'uses' => 'Estate\PaypalSubscriptionController@create',
            'as' => 'estate.subscription.add'
        ]);

        //Store Subscription Route
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
            'as' => 'estate.amenities'
        ]);

        //Get Amenity Route
        Route::get('amenity/{id}', [
            'uses' => 'Estate\AmenityController@edit',
            'as' => 'estate.amenity.edit'
        ]);

        //Post Add Amenity Route
        Route::post('amenity/add', [
            'uses' => 'Estate\AmenityController@store',
            'as' => 'estate.amenity.store'
        ]);

        //Post Update Amenity Route
        Route::post('amenity/update', [
            'uses' => 'Estate\AmenityController@update',
            'as' => 'estate.amenity.update'
        ]);

        //Get Update Amenity Status Route
        Route::get('amenity/status/{id}', [
            'uses' => 'Estate\AmenityController@toggleStatus',
            'as' => 'estate.amenity.status'
        ]);

        //Get Delete Amenity Route
        Route::get('amenity/delete/{id}', [
            'uses' => 'Estate\AmenityController@delete',
            'as' => 'estate.amenity.delete'
        ]);

        //Get Restore Amenity Route
        Route::get('amenity/restore/{id}', [
            'uses' => 'Estate\AmenityController@restore',
            'as' => 'estate.amenity.restore'
        ]);

        //Get Destroy Amenity Route
        Route::get('amenity/destroy/{id}', [
            'uses' => 'Estate\AmenityController@destroy',
            'as' => 'estate.amenity.destroy'
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
            'as' => 'estate.group.add'
        ]);

        //Get Groups Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\GroupController@index',
            'as' => 'estate.groups.index'
        ]);

        //Get Group Route
        Route::get('group/{id}', [
            'uses' => 'Estate\GroupController@edit',
            'as' => 'estate.group.edit'
        ]);

        //Post Add Group Route
        Route::post('group/add', [
            'uses' => 'Estate\GroupController@store',
            'as' => 'estate.group.store'
        ]);

        //Post Update Group Route
        Route::post('group/update', [
            'uses' => 'Estate\GroupController@update',
            'as' => 'estate.group.update'
        ]);

        //Get Update Group Status Route
        Route::get('group/status/{id}', [
            'uses' => 'Estate\GroupController@toggleStatus',
            'as' => 'estate.group.status'
        ]);

        //Get Delete Group Route
        Route::get('group/delete/{id}', [
            'uses' => 'Estate\GroupController@delete',
            'as' => 'estate.group.delete'
        ]);

        //Get Restore Group Route
        Route::get('group/restore/{id}', [
            'uses' => 'Estate\GroupController@restore',
            'as' => 'estate.group.restore'
        ]);

        //Get Destroy Group Route
        Route::get('group/destroy/{id}', [
            'uses' => 'Estate\GroupController@destroy',
            'as' => 'estate.group.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Company Properties Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'properties'], function () {
//Add Property Route
        Route::get('property/add-estate-property/{id}', [
            'uses' => 'Estate\PropertyController@create',
            'as' => 'estate.property.add'
        ]);

        //Get Properties Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\PropertyController@index',
            'as' => 'estate.properties'
        ]);

        //Get Property Route
        Route::get('property/{id}', [
            'uses' => 'Estate\PropertyController@edit',
            'as' => 'estate.property.edit'
        ]);

        //Get Property Amenities Route
        Route::get('property/amenities/{id}', [
            'uses' => 'Estate\PropertyController@amenities',
            'as' => 'estate.property.amenities'
        ]);

        //Get Property Features Route
        Route::get('property/features/{id}', [
            'uses' => 'Estate\PropertyController@features',
            'as' => 'estate.property.features'
        ]);

        //Post Add Property Route
        Route::post('property/add', [
            'uses' => 'Estate\PropertyController@store',
            'as' => 'estate.property.store'
        ]);

        //Post Update Property Route
        Route::post('property/update', [
            'uses' => 'Estate\PropertyController@update',
            'as' => 'estate.property.update'
        ]);

        //Post Update Property Amenities Route
        Route::post('property/amenities-update', [
            'uses' => 'Estate\PropertyController@updateAmenities',
            'as' => 'estate.property.amenities.update'
        ]);

        //Post Add Property Features Route
        Route::post('property/features-add', [
            'uses' => 'Estate\PropertyController@addFeatures',
            'as' => 'estate.property.features.add'
        ]);

        //Post Update Property Features Route
        Route::post('property/features-update', [
            'uses' => 'Estate\PropertyController@updateFeature',
            'as' => 'estate.property.features.update'
        ]);

        //Get Update Property Status Route
        Route::get('property/status/{id}', [
            'uses' => 'Estate\PropertyController@toggleStatus',
            'as' => 'estate.property.status'
        ]);

        //Get Update Property Feature Status Route
        Route::get('property/feature-status/{id}', [
            'uses' => 'Estate\PropertyController@toggleFeatureStatus',
            'as' => 'estate.property.feature.status'
        ]);

        //Get Delete Property Route
        Route::get('property/delete/{id}', [
            'uses' => 'Estate\PropertyController@delete',
            'as' => 'estate.property.delete'
        ]);

        //Get Delete Property Feature Route
        Route::get('property/delete-feature/{id}', [
            'uses' => 'Estate\PropertyController@deleteFeature',
            'as' => 'estate.property.feature.delete'
        ]);

        //Get Restore Property Route
        Route::get('property/restore/{id}', [
            'uses' => 'Estate\PropertyController@restore',
            'as' => 'estate.property.restore'
        ]);

        //Get Destroy Property Route
        Route::get('property/destroy/{id}', [
            'uses' => 'Estate\PropertyController@destroy',
            'as' => 'estate.property.destroy'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Company Tenant Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'tenants'], function () {
//Add Tenant Route
        Route::get('add-estate-tenant/{id}', [
            'uses' => 'Estate\TenantController@create',
            'as' => 'estate.tenant.add'
        ]);

        //Get Group Property Route
        Route::post('group/properties', [
            'uses' => 'Estate\TenantController@groupProperties',
            'as' => 'estate.tenant.group.properties'
        ]);

        //Get Tenants Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\TenantController@index',
            'as' => 'estate.tenants'
        ]);

        //Get Group Route
        Route::get('tenant/lease/{id}', [
            'uses' => 'Estate\TenantController@edit',
            'as' => 'estate.lease.edit'
        ]);

        //Post Add Group Route
        Route::post('tenant/add', [
            'uses' => 'Estate\TenantController@store',
            'as' => 'estate.tenant.store'
        ]);

        //Post Update Group Route
        Route::post('tenant/lease/update', [
            'uses' => 'Estate\TenantController@update',
            'as' => 'estate.tenant.update'
        ]);

        //Get Update Tenant Lease Status Route
        Route::get('tenant/lease/status/{id}', [
            'uses' => 'Estate\TenantController@toggleStatus',
            'as' => 'estate.lease.status'
        ]);

        //Get Delete Tenant Lease Route
        Route::get('tenant/lease/delete/{id}', [
            'uses' => 'Estate\TenantController@delete',
            'as' => 'estate.lease.delete'
        ]);

        //Get Restore Tenant Lease Route
        Route::get('tenant/lease/restore/{id}', [
            'uses' => 'Estate\TenantController@restore',
            'as' => 'estate.lease.restore'
        ]);

        //Get Destroy Tenant Lease Route
        Route::get('tenant/lease/destroy/{id}', [
            'uses' => 'Estate\TenantController@destroy',
            'as' => 'estate.lease.destroy'
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
            'as' => 'estate.bills.service.add'
        ]);

        //Edit Bill Service Route
        Route::get('service/edit-service/{id}', [
            'uses' => 'Estate\BillServiceController@edit',
            'as' => 'estate.bills.service.edit'
        ]);

        //Bills Service Settings Route
        Route::get('services/{id}/{sort}', [
            'uses' => 'Estate\BillServiceController@index',
            'as' => 'estate.bills.services'
        ]);

        //Post Add Bill Service Route
        Route::post('service/add', [
            'uses' => 'Estate\BillServiceController@store',
            'as' => 'estate.bills.service.store'
        ]);

        //Post Update Bill Service Route
        Route::post('service/update', [
            'uses' => 'Estate\BillServiceController@update',
            'as' => 'estate.bills.service.update'
        ]);

        //Update Bill Service Status Route
        Route::get('service/status/{id}', [
            'uses' => 'Estate\BillServiceController@toggleStatus',
            'as' => 'estate.bills.service.status'
        ]);

        //Delete Bill Service Route
        Route::get('service/delete/{id}', [
            'uses' => 'Estate\BillServiceController@delete',
            'as' => 'estate.bills.service.delete'
        ]);

        //Restore Bill Service Route
        Route::get('service/restore/{id}', [
            'uses' => 'Estate\BillServiceController@restore',
            'as' => 'estate.bills.service.restore'
        ]);

        //Destroy Bill Service Route
        Route::get('service/destroy/{id}', [
            'uses' => 'Estate\BillServiceController@destroy',
            'as' => 'estate.bills.service.destroy'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Company Bill Invoice Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'bills'], function () {
        //Add Bill Route
        Route::get('generate/invoices/{id}', [
            'uses' => 'Estate\BillController@generateInvoices',
            'as' => 'estate.bills.generate'
        ]);

        //Add Bill Route
        Route::get('create/bills/{id}', [
            'uses' => 'Estate\BillController@create',
            'as' => 'estate.bill.add'
        ]);

        //Edit Bill Route
        Route::get('edit/bill/{id}', [
            'uses' => 'Estate\BillController@edit',
            'as' => 'estate.bills.invoice.edit'
        ]);

        //Bills Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\BillController@index',
            'as' => 'estate.bills.tenants'
        ]);

        //Bills To PDF Route
        Route::get('reports/{id}/{sort}', [
            'uses' => 'Estate\BillController@pdfReport',
            'as' => 'estate.bills.report.pdf'
        ]);

        //Post Add Bill Service Route
        Route::post('invoice/add', [
            'uses' => 'Estate\BillController@store',
            'as' => 'estate.bills.invoices.store'
        ]);

        //Post Update Bill Service Route
        Route::post('invoice/update', [
            'uses' => 'Estate\BillController@update',
            'as' => 'estate.bills.invoice.update'
        ]);

        //Update Bill Invoice Status Route
        Route::get('status/bill/{id}', [
            'uses' => 'Estate\BillController@toggleStatus',
            'as' => 'estate.bills.invoice.status'
        ]);

        //Delete Bill Invoice Route
        Route::get('delete/bill/{id?}', [
            'uses' => 'Estate\BillController@delete',
            'as' => 'estate.bills.invoice.delete'
        ]);

        //Restore Bill Invoice Route
        Route::get('restore/bill/{id}', [
            'uses' => 'Estate\BillController@restore',
            'as' => 'estate.bills.invoice.restore'
        ]);

        //Destroy Bill Invoice Route
        Route::get('destroy/bill/{id?}', [
            'uses' => 'Estate\BillController@destroy',
            'as' => 'estate.bills.invoice.destroy'
        ]);

    });

    /**
     * -----------------------------------------------------------------
     * Company Rent Routes
     * -----------------------------------------------------------------
     */
    Route::group(['prefix' => 'rents'], function () {
        //Add Rent Route
        Route::get('rent/add-tenant/{id}', [
            'uses' => 'Estate\RentController@create',
            'as' => 'estate.rent.add'
        ]);

        //Add Rent Route
        Route::get('rent/generate-invoice/{id}', [
            'uses' => 'Estate\RentController@invoice',
            'as' => 'estate.rent.generate.invoice'
        ]);

        //Get Rent Group Properties Route
        Route::post('rent/properties', [
            'uses' => 'Estate\RentController@groupProperties',
            'as' => 'estate.rent.group.properties'
        ]);

        //Get Rent Group Property Route
        Route::post('rent/property', [
            'uses' => 'Estate\RentController@groupProperty',
            'as' => 'estate.rent.group.property'
        ]);

        //Edit Rent Route
        Route::get('edit/rent/{id}', [
            'uses' => 'Estate\RentController@edit',
            'as' => 'estate.rent.edit'
        ]);

        //Get Rents Route
        Route::get('index/{id}/{sort}', [
            'uses' => 'Estate\RentController@index',
            'as' => 'estate.rents'
        ]);

        //Rents To PDF Route
        Route::get('reports/{id}/{sort}', [
            'uses' => 'Estate\RentController@pdfReport',
            'as' => 'estate.rents.report.pdf'
        ]);

        //Post Add Rent Invoice Route
        Route::post('rent/add', [
            'uses' => 'Estate\RentController@store',
            'as' => 'estate.rent.store'
        ]);

        //Post Update Rent Invoice Route
        Route::post('rent/update', [
            'uses' => 'Estate\RentController@update',
            'as' => 'estate.rent.update'
        ]);

        //Update Rent Invoice Status Route
        Route::get('rent/status/{id}', [
            'uses' => 'Estate\RentController@toggleStatus',
            'as' => 'estate.rent.status'
        ]);

        //Get Delete Rent Invoice Route
        Route::get('rent/delete/{id?}', [
            'uses' => 'Estate\RentController@delete',
            'as' => 'estate.rent.delete'
        ]);

        //Get Restore Rent Invoice Route
        Route::get('rent/restore/{id}', [
            'uses' => 'Estate\RentController@restore',
            'as' => 'estate.rent.restore'
        ]);

        //Get Destroy Rent Invoice Route
        Route::get('rent/destroy/{id?}', [
            'uses' => 'Estate\RentController@destroy',
            'as' => 'estate.rent.destroy'
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
        //tenant rent
        Route::get('rent/invoice/{id}', [
            'uses' => 'Tenant\RentController@rent',
            'as' => 'tenant.rent'
        ]);

        //tenant rent invoice to pdf
        Route::get('download/rent/invoice/{id}/pdf', [
            'uses' => 'Tenant\RentController@rentToPdf',
            'as' => 'tenant.rent.download.pdf'
        ]);

        //tenant rents
        Route::get('index/{id}', [
            'uses' => 'Tenant\RentController@index',
            'as' => 'tenant.rents'
        ]);
    });

    /**
     * -----------------------------------------------------------------
     * Rent Routes Group
     * -----------------------------------------------------------------
     * Handles all tenant rents routes
     */
    Route::group(['prefix' => 'bills'], function () {
        //tenant bill
        Route::get('bill/invoice/{id}', [
            'uses' => 'Tenant\BillController@bill',
            'as' => 'tenant.bill'
        ]);

        //tenant bill invoice to pdf
        Route::get('download/bill/invoice/{id}/pdf', [
            'uses' => 'Tenant\BillController@billToPdf',
            'as' => 'tenant.bill.download.pdf'
        ]);

        //tenant bills
        Route::get('index/{id}', [
            'uses' => 'Tenant\BillController@index',
            'as' => 'tenant.bills'
        ]);
    });

    //tenant rent status
    Route::get('rent/status/{id}', [
        'uses' => 'Tenant\RentController@toggleStatus',
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

    Route::get('dashboard/{section?}', [
        'uses' => 'UserController@dashboard',
        'as' => 'user.dashboard',
    ]);

    Route::get('profile', [
        'uses' => 'UserController@profile',
        'as' => 'user.profile'
    ]);

    //user profile update
    Route::post('profile-update', [
        'uses' => 'UserController@update',
        'as' => 'user.profile.update'
    ]);

    //user avatar upload view
    Route::get('profile/avatar', [
        'uses' => 'User\AvatarController@avatar',
        'as' => 'user.avatar'
    ]);

    //user avatar store
    Route::post('avatar/store', [
        'uses' => 'User\AvatarController@store',
        'as' => 'user.avatar.store'
    ]);

    //user avatar update
    Route::get('avatar/update/{id}', [
        'uses' => 'User\AvatarController@update',
        'as' => 'user.avatar.update'
    ]);

    //user avatar update
    Route::get('avatar/delete/{id}', [
        'uses' => 'User\AvatarController@delete',
        'as' => 'user.avatar.delete'
    ]);

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
    Route::group(['prefix' => 'admin', 'middleware' => 'company.app.admin'], function () {

        /**
         * -----------------------------------------------------------------
         * App Admin Routes
         * -----------------------------------------------------------------
         */
        //Post Update App
        Route::post('update-app', [
            'uses' => 'Estate\AdminController@update',
            'as' => 'app.update'
        ]);

        //Post Update App Status
        Route::get('status/{id}', [
            'uses' => 'Estate\AdminController@toggleStatus',
            'as' => 'app.status'
        ]);

        //Get Delete App Feature
        Route::get('delete/{id}', [
            'uses' => 'Estate\AdminController@delete',
            'as' => 'app.delete'
        ]);

        //Get Restore App Feature
        Route::get('restore/{id}', [
            'uses' => 'Estate\AdminController@restore',
            'as' => 'app.restore'
        ]);

        //Get Destroy App Feature
        Route::get('destroy/{id}', [
            'uses' => 'Estate\AdminController@destroy',
            'as' => 'app.destroy'
        ]);
    });

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
