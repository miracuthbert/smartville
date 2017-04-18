<?php

namespace App\Observers;

use App\Models\v1\Tenant\TenantBill;
use App\Notifications\Tenant\TenantBilledNotification;

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

            //bill
            $bill = $tenantBill->bill;

            //company
            $company = $bill->app->company;
            
            //get user
            $user = $tenantBill->lease->tenant->user;

            //notify
            $user->notify(new TenantBilledNotification($tenantBill, $bill, $company));
        }
    }

}