<?php

namespace App\Handlers;


use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateBill;
use App\Models\v1\Tenant\TenantBill;
use App\Notifications\EstateBillingReminder;
use App\Notifications\Rental\Bills\CreateInvoiceReminderNotification;
use App\Notifications\Rental\Bills\PendingBillsNotification;
use Carbon\Carbon;
use ExtCountries;

class AppBillingHandler
{
    /**
     * Holds app timezone
     *
     * @var $timezone
     */
    protected static $timezone;

    /**
     * AppBillingHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * Handles App Billing Day Reminder
     */
    public static function billingDayReminder()
    {

        //date
        $date = Carbon::now();

        //days in month
        $daysOfMonth = $date->daysInMonth;

        //day of month
        $dayOfMonth = $date->day;

        //days in month
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

        if (count($apps) > 0) { //notify apps if greater than one
            //loop
            foreach ($apps as $app) {
                //app bills
                $bills = $app->billingServices;

                foreach ($bills as $bill) {
                    //notify
                    $app->notify(new CreateInvoiceReminderNotification($app, $bill));
                }
            }
        }
    }

    /**
     * Handles App Bills Due Reminder
     */
    public static function billsDueReminder()
    {

        //today
        $today = Carbon::today();

        //find bills
        $bills = EstateBill::whereHas(
            'tenantBills', function ($query) {
            $query->where('status', 0)
                ->whereDate('date_due', Carbon::today());
        })->with([
            'tenantBills' => function ($query) {
                $query->whereDate('date_due', Carbon::today())
                    ->where('status', 0)
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC');
            }])->withCount(['tenantBills' => function ($query) {
            $query->where('status', 0)
                ->whereNull('paid_at')
                ->whereDate('date_due', Carbon::today());
        }])->get();

        if (count($bills) > 0) { //notify apps if greater than one
            //loop through estate bills
            foreach ($bills as $bill) {
                //bill app
                $app = $bill->app;

                //total pending bills
                $total = $bill->tenant_bills_count;

                //notify
                $app->notify(new PendingBillsNotification($app, $bill, $total, 1));

                //tenant bills
                #TODO:uncomment lines below and loop through them to notify tenants too
//                $tenant_bills = $bill->tenantBills()->whereDate('date_due', Carbon::today($timezone))
//                    ->where('status', 0)
//                    ->whereNull('paid_at')
//                    ->orderBy('date_due', 'ASC');
//
            }
        }
    }

    /**
     * Handles App Bills Past Due Reminder
     */
    public static function billsPastDueReminder()
    {

        //today
        $today = Carbon::today();

        //find bills
        $bills = EstateBill::whereHas(
            'tenantBills', function ($query) {
            $query->where('status', 0)
                ->whereDate('date_due', '<', Carbon::today());
        })->with([
            'tenantBills' => function ($query) {
                $query->whereDate('date_due', '<', Carbon::today())
                    ->where('status', 0)
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC');
            }])->withCount(['tenantBills' => function ($query) {
            $query->where('status', 0)
                ->whereNull('paid_at')
                ->whereDate('date_due', '<', Carbon::today());
        }])->get();

        if (count($bills) > 0) { //notify apps if greater than one
            //loop through estate bills
            foreach ($bills as $bill) {
                //bill app
                $app = $bill->app;

                //total pending bills
                $total = $bill->tenant_bills_count;

                //notify
                $app->notify(new PendingBillsNotification($app, $bill, $total, 0));

                //tenant bills
                #TODO:uncomment lines below and loop through them to notify tenants too
//                $tenant_bills = $bill->tenantBills()->whereDate('date_due', Carbon::today($timezone))
//                    ->where('status', 0)
//                    ->whereNull('paid_at')
//                    ->orderBy('date_due', 'ASC');

            }
        }
    }

    private function demo()
    {
        //find apps
        $apps = CompanyApp::with([
            'company',
            'billingServices' => function ($query) {
                $query->where('status', 1);
            }
        ])->where('status', 1)->get();

        //loop apps
        foreach ($apps as $app) {
            //company
            $company = $app->company;

            //country timezones
            $ctz = ExtCountries::where('name.common', $company->country)->first()->timezone;

            if (count($ctz) > 1) {
                //get states
                $states = ExtCountries::where('name.common', $company->country)->first()->states->pluck('name', 'postal');

                //find state
                $state = collect($states)->search($company->state);

                $ctz = $ctz[$state];
            } else {
                $ctz = $ctz;
            }

            //app bills
            $bills = $app->billingServices()->withCount(['tenantBills' => function ($query, $ctz) {
                $query->where('status', 0)
                    ->whereNull('paid_at')
                    ->whereDate('date_due', Carbon::today($ctz));
            }]);

//            dd(Carbon::today($ctz));

            //loop app bills
            foreach ($bills as $bill) {
                //bill app
                $app = $bill->app;

                //total pending bills
                $total = $bill->tenant_bills_count;

                //notify
                $app->notify(new PendingBillsNotification($app, $bill, $total, 1));

                //tenant bills
                #TODO:uncomment lines below and loop through them to notify tenants too
//                $tenant_bills = $bill->tenantBills()->whereDate('date_due', Carbon::today($timezone))
//                    ->where('status', 0)
//                    ->whereNull('paid_at')
//                    ->orderBy('date_due', 'ASC');

            }
        }
    }
}