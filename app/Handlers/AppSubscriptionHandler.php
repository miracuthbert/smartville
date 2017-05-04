<?php

namespace App\Handlers;


use App\Models\v1\Company\AppTrial;
use App\Models\v1\Estate\Paypal;
use App\Notifications\Company\CompanyAppSubscriptionEndedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AppSubscriptionHandler
{

    /**
     * AppSubscriptionHandler constructor.
     */
    public function __construct()
    {
    }

    /**
     * Handles ending of expired subscription
     */
    public static function subscriptionEnd()
    {
        //find companies with active subscriptions
        $subscriptions = Paypal::where('completed', 1)->where('ends_at', '<', Carbon::now())->get();

        //loop and end
        foreach ($subscriptions as $subscription) {
            $app = $subscription->app;

            $company = $app->company;

            //check if app is subscribed
            if ($app->subscribed == 1 && !$app->is_trial) {
                //disable subscription
                $update = $app->update(['subscribed' => 0]);

                if ($update) {
                    //notify
                    $app->notify(new CompanyAppSubscriptionEndedNotification($app, $company, $subscription, 'paypal'));

                }
            }
        }

        //find companies with trial subscriptions
        $subscriptions = AppTrial::where('is_ended', 0)->where('trial_ends_at', '<', Carbon::now())->get();

        //loop and end
        foreach ($subscriptions as $subscription) {
            $app = $subscription->app;

            $company = $app->company;

            //check if app is subscribed
            if ($app->subscribed && $app->is_trial) {

                $ended = $subscription->update(['is_ended' => 1]);

                //disable subscription
                $update = $app->update(['is_trial' => 0, 'subscribed' => 0]);

                if ($update)
                    //notify
                    $app->notify(new CompanyAppSubscriptionEndedNotification($app, $company, $subscription, 'trial'));
            }
        }

    }
}