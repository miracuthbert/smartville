<?php
return [

    /*
     * -------------------------------------------------------------------
     * Email Activation
     * Is email activation required
     * Set 'true' to allow activation; 'false' to disable activation
     * -------------------------------------------------------------------
     */
    'send_activation_email' => env('SETTINGS_SEND_ACTIVATION_EMAIL', true),

    'avatar_storage_user' => 'images/avatars/users',

    'avatar_storage_company' => 'images/avatars/companies',

];