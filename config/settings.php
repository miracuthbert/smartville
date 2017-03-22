<?php
return [

    /**
     * -------------------------------------------------------------------
     * Email Activation
     * Is email activation required
     * Set 'true' to allow activation; 'false' to disable activation
     * -------------------------------------------------------------------
     */
    'send_activation_email' => env('SETTINGS_SEND_ACTIVATION_EMAIL', true),

    'avatar_storage_user' => 'images/avatars/users',

    'avatar_storage_company' => 'images/avatars/companies',

    /**
     * Rental App
     * Default Settings
     * Version 1.0
     */
    'rental_app' => array(
        /**
         * Layouts
         * properties, tenants
         */
        'layouts' => array(
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
        ),

        /**
         * Notifications
         * web, email, sms
         */
        'notifications' => array(
            //web
            'web' => true,

            //email
            'email' => true,

            //sms
            'sms' => false,
        ),

        /**
         * Sort Options
         * properties, tenants
         */
        //property groups
        'property_groups_options' => array(
            'sort' => 'all',
        ),
        //properties
        'properties_options' => array(
            'sort' => 'all',
        ),
        //tenants
        'tenants_options' => array(
            'sort' => 'all',
            'leases' => false,
        ),
        //rent
        'rent_options' => array(
            'sort' => 'all',
        ),
        //bills
        'bills_options' => array(
            'sort' => 'all',
        ),
    ),

];