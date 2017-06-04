<?php

namespace App\Observers;

use App\Models\v1\Tenant\TenantBill;
use App\Notifications\Tenant\TenantBilledNotification;
use Carbon\Carbon;

class TenantBillObserver
{

    /**
     * Listen to the TenantBill created event.
     *
     * @param  TenantBill $tenantBill
     * @return void
     */
    public function created(TenantBill $tenantBill)
    {
        if ($tenantBill) {

            //Bill Service
            $bill = $tenantBill->bill;

            //Company
            $company = $bill->app->company;
            
            //Get User
            $user = $tenantBill->lease->tenant->user;

            //Bill Route
            $route = route('tenant.bill', ['id' => $tenantBill->id]);

            //Notification Queue Time
            $when = Carbon::now()->addMinute();

            //Notify User
            $user->notify((new TenantBilledNotification($tenantBill, $bill, $company, $user, $route))->delay($when));
        }
    }

}