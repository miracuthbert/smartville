<?php

namespace App\Observers\Tenant;

use App\Models\v1\Tenant\TenantProperty;
use App\Notifications\Tenant\TenantAddedNotification;
use Illuminate\Support\Facades\Auth;

class TenantPropertyObserver
{

    /**
     * Listen to the CompanyApp created event.
     *
     * @param  TenantProperty $tenantProperty
     * @return void
     */
    public function created(TenantProperty $tenantProperty)
    {
        if ($tenantProperty) {

            //tenant
            $tenant = $tenantProperty->tenant;

            //user
            $user = $tenant->user;
            
            //user dash route
            $route = AppDashRoute('user.dashboard');

            //app
            $app = $tenant->company;
            
            //company
            $company = $app->company;

            //message
            $message = "You have been added to " . $company->title;

            //notify
            $user->notify(new TenantAddedNotification($tenantProperty, $app, $company, $user, $message, $route));
        }
    }

}