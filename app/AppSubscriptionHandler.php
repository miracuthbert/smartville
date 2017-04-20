<?php

namespace App;


use App\Models\v1\Company\AppTrial;
use App\Models\v1\Estate\Paypal;
use App\Notifications\Company\CompanyAppSubscriptionEndedNotification;
use Carbon\Carbon;

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
    public function subscriptionEnd()
    {
        //find companies with active subscriptions
        $subscriptions = Paypal::where('completed', 1)->where('ends_at', '<', Carbon::now());

        //loop and end
        foreach ($subscriptions as $subscription) {
            $app = $subscription->app;

            $company = $app->company;

            //check if app is subscribed
            if ($app->subcribed) {
                //disable subscription
                $update = $app->update(['subscribed', 1]);

                if ($update)
                    //notify
                    $app->notify(new CompanyAppSubscriptionEndedNotification($app, $company, $subscription, 'paypal'));
            }
        }

        //find companies with trial subscriptions
        $subscriptions = AppTrial::where('is_ended', 0)->where('ends_at', '<', Carbon::now());

        //loop and end
        foreach ($subscriptions as $subscription) {
            $app = $subscription->app;

            $company = $app->company;

            //check if app is subscribed
            if ($app->subcribed) {
                //disable subscription
                $update = $app->update(['subscribed', 1]);

                if ($update)
                    //notify
                    $app->notify(new CompanyAppSubscriptionEndedNotification($app, $company, $subscription, 'trial'));
            }
        }

    }
}