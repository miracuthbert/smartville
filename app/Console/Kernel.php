<?php

namespace App\Console;

use App\Handlers\AppBillingHandler;
use App\Handlers\AppRentalHandler;
use App\Handlers\AppSubscriptionHandler;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        //schedule app daily tasks
        $schedule->call(function () {
            AppBillingHandler::billsDueReminder();          //app bills due reminder
            AppBillingHandler::billsPastDueReminder();      //app bills past due reminder
            AppBillingHandler::billingDayReminder();        //app billing day reminder
            AppRentalHandler::rentDueReminder();            //app rents due reminder
            AppRentalHandler::rentPastDueReminder();        //app rents past due reminder
        })->daily();

        //schedule app daily tasks at 13 hrs
        $schedule->call(function () {
            AppBillingHandler::billsDueReminder();          //app bills due reminder
            AppBillingHandler::billsPastDueReminder();      //app bills past due reminder
            AppBillingHandler::billingDayReminder();        //app billing day reminder
            AppRentalHandler::rentDueReminder();            //app rents due reminder
            AppRentalHandler::rentPastDueReminder();        //app rents past due reminder
        })->dailyAt('13:00');

        //schedule app daily tasks at 16 hrs
        $schedule->call(function () {
            AppBillingHandler::billsDueReminder();          //app bills due reminder
            AppBillingHandler::billsPastDueReminder();      //app bills past due reminder
            AppBillingHandler::billingDayReminder();        //app billing day reminder
            AppRentalHandler::rentDueReminder();            //app rents due reminder
            AppRentalHandler::rentPastDueReminder();        //app rents past due reminder
        })->dailyAt('16:00');

        //schedule app tasks twice daily at 6 and 9
        $schedule->call(function () {
            AppBillingHandler::billsDueReminder();          //app bills due reminder
            AppBillingHandler::billsPastDueReminder();      //app bills past due reminder
            AppBillingHandler::billingDayReminder();        //app billing day reminder
            AppRentalHandler::rentDueReminder();            //app rents due reminder
            AppRentalHandler::rentPastDueReminder();        //app rents past due reminder
        })->twiceDaily(6,9);

        //schedule app subscription handles
        $schedule->call(function () {
            #TODO: Comment Lines Below That Do
//            AppBillingHandler::billsDueReminder();          //app bills due reminder
//            AppBillingHandler::billsPastDueReminder();      //app bills past due reminder
//            AppBillingHandler::billingDayReminder();        //app billing day reminder
//            AppRentalHandler::rentDueReminder();            //app rents due reminder
//            AppRentalHandler::rentPastDueReminder();        //app rents past due reminder
            AppSubscriptionHandler::subscriptionEnd();  //app subscription reminder
        })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
