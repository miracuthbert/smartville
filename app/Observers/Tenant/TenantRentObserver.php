<?php

namespace App\Observers;


use App\Models\v1\Tenant\TenantRent;
use App\Notifications\Tenant\RentInvoiceSentNotification;

class TenantRentObserver
{
    /**
     * Listen to the TenantRent created event.
     *
     * @param TenantRent $tenantRent
     * @return void
     */
    public function created(TenantRent $tenantRent)
    {
        if ($tenantRent) {

            //lease
            $lease = $tenantRent->lease;

            //tenant
            $tenant = $lease->tenant;

            //user
            $user = $tenant->user;

            //user dash route
            $route = route('tenant.rent', ['id' => $tenantRent->id]);

            //app
            $app = $tenant->company;

            //company
            $company = $app->company;

            //notify
            $user->notify(new RentInvoiceSentNotification($tenantRent, $app, $company, $user, $route));
        }
    }
}