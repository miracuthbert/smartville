<?php

namespace App\Handlers;


use App\Models\v1\Company\CompanyApp;
use App\Notifications\Rental\Rent\PendingRentsNotification;
use Carbon\Carbon;

class AppRentalHandler
{

    /**
     * AppRentalHandler constructor.
     */
    public function __construct()
    {
    }

    public static function propertyRentReminder()
    {

        //date
        $date = Carbon::now();

        //day of month
        $dayOfMonth = $date->day;

        //last days in month
        $lastDayOfMonth = $date->lastOfMonth()->day;

        //Check if today is last day of month
        //if true then get bills with billing reminder
        //greater than the # of days of current month
        //else get bills with reminder set today
        if ($lastDayOfMonth == $dayOfMonth) {
//            $bills = EstateBill::where('billing_reminder', '>', $daysOfMonth)->where('status', 1)->get();
            //get all apps
            $apps = CompanyApp::whereHas(
                'billingServices', function ($query) {
                $query->where('status', 1)
                    ->where('billing_reminder', Carbon::today()->day);
            })->with([
                'billingServices' => function ($query) {
                    $query->where('status', 1)
                        ->where('billing_reminder', '>', Carbon::today()->day);
                }])->withCount(['billingServices' => function ($query) {
                $query->where('status', 1)
                    ->where('billing_reminder', '>', Carbon::today()->day);
            }])->get();
        } else {
//            $bills = EstateBill::where('billing_reminder', $dayOfMonth)->where('status', 1)->get();
            //get all apps
            $apps = CompanyApp::whereHas(
                'billingServices', function ($query) {
                $query->where('status', 1)
                    ->where('billing_reminder', Carbon::today()->day);
            })->with([
                'billingServices' => function ($query) {
                    $query->where('status', 1)
                        ->where('billing_reminder', Carbon::today()->day);
                }])->withCount(['billingServices' => function ($query) {
                $query->where('status', 1)
                    ->where('billing_reminder', Carbon::today()->day);
            }])->get();
        }

    }

    public static function rentDueReminder()
    {

        //find apps with rent due today
        $apps = CompanyApp::whereHas('rents', function ($query) {
            $query->where('tenant_rents.status', 0)
                ->whereNull('paid_at')
                ->where('date_due', Carbon::today());
        })->withCount(['rents' => function ($query) {
            $query->where('tenant_rents.status', 1)
                ->whereNull('paid_at')
                ->where('date_due', Carbon::today());
        }])->get();

//        dd($apps);

        if (count($apps) > 0) {
            //loop through app data
            foreach ($apps as $app) {
                //total
                $total = $app->rents_count;

                if ($total > 0) {    //check if total is greater than 0
                    $app->notify(new PendingRentsNotification($app, $total, 1));
                }
            }
        }
    }

    public static function rentPastDueReminder()
    {

        //find apps with rent due today
        $apps = CompanyApp::whereHas('rents', function ($query) {
            $query->where('tenant_rents.status', 0)
                ->whereNull('paid_at')
                ->where('date_due', '<', Carbon::today());
        })->withCount(['rents' => function ($query) {
            $query->where('tenant_rents.status', 1)
                ->whereNull('paid_at')
                ->where('date_due', '<', Carbon::today());
        }])->get();

//        dd($apps);

        if (count($apps) > 0) {
            //loop through app data
            foreach ($apps as $app) {
                //total
                $total = $app->rents_count;

                if ($total > 0) {    //check if total is greater than 0
                    $app->notify(new PendingRentsNotification($app, $total, 0));
                }
            }
        }
    }
}