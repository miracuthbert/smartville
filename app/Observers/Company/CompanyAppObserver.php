<?php

namespace App\Observers\Company;

use App\Models\v1\Company\CompanyApp;
use App\Notifications\Company\CompanyAppCreatedNotification;

class CompanyAppObserver
{

    /**
     * Listen to the CompanyApp created event.
     *
     * @param  CompanyApp $companyApp
     * @return void
     */
    public function created(CompanyApp $companyApp)
    {
        if ($companyApp) {

            //product
            $product = $companyApp->product;

            //app route
            $route = AppDashRoute($product);

            //company
            $company = $companyApp->company;

            //message
            $message = "You have successfully created a new " . $product->title;

            //notify
            $companyApp->notify(new CompanyAppCreatedNotification($companyApp, $company, $product, $message, $route));
        }
    }

}