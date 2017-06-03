<?php
return [
    /**
     * -------------------------------------------------------------------
     * Site Settings
     * Default Site Settings
     * These settings can be overridden by creating an alt. settings file
     * Or Using a 'Database'
     * -------------------------------------------------------------------
     */
    'site_settings' => [
        //no of allowed trials
        'trials' => 2,

        //no of trial days
        'trial_days' => 14,
    ],

    /**
     * -------------------------------------------------------------------
     * Email Activation
     * Is email activation required
     * Set 'true' to allow activation; 'false' to disable activation
     * -------------------------------------------------------------------
     */
    'send_activation_email' => env('SETTINGS_SEND_ACTIVATION_EMAIL', true),

    /**
     * -------------------------------------------------------------------
     * Avatar Storage Path For Users
     * Holds the initial storage path for user avatar's/profile picture
     * -------------------------------------------------------------------
     */
    'avatar_storage_user' => 'images/avatars/users',

    /**
     * -------------------------------------------------------------------
     * Avatar Storage Path For Companies
     * Holds the initial storage path for company avatar's/logo
     * -------------------------------------------------------------------
     */
    'avatar_storage_company' => 'images/avatars/companies',

    /**
     * -------------------------------------------------------------------
     * Property Gallery Storage Path
     * Holds the initial storage path for property galleries
     * -------------------------------------------------------------------
     */
    'property_storage_gallery' => 'images/galleries/properties',

    /**
     * -------------------------------------------------------------------
     * Rental App
     * Default Settings
     * Holds default settings for rental app
     * Push to Database when creating an app
     * Version 1.0
     * -------------------------------------------------------------------
     */
    'rental_app' => [
        /**
         * -------------------------------------------------------------------
         * Layouts
         * properties, tenants
         * -------------------------------------------------------------------
         */
        'layouts' => [
            //groups layout
            'groups' => 'list',

            //properties layout
            'properties' => 'list',

            //tenants layout
            'tenants' => 'list',

            //rent layout
            'rent' => 'list',

            //bills layout
            'bills' => 'list',
        ],

        /**
         * -------------------------------------------------------------------
         * Notifications
         * web, email, sms
         * -------------------------------------------------------------------
         */
        'notifications' => [
            //web
            'web' => true,

            //email
            'email' => true,

            //sms
            'sms' => false,
        ],

        /**
         * -------------------------------------------------------------------
         * Sort Options
         * properties, tenants
         * -------------------------------------------------------------------
         */
        //property groups
        'property_groups_options' => [
            'sort' => 'all',
        ],
        //properties
        'properties_options' => [
            'sort' => 'all',
        ],
        //tenants
        'tenants_options' => [
            'sort' => 'all',
            'leases' => false,
        ],
        //rent
        'rent_options' => [
            'sort' => 'all',
        ],
        //bills
        'bills_options' => [
            'sort' => 'all',
        ],
    ],

];