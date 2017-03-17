<?php
/**
 * Created by PhpStorm.
 * User: Cuthbert Mirambo
 * Date: 2/19/2017
 * Time: 11:20 PM
 */

namespace App\Traits;

use Carbon\Carbon;

trait AppSubscribed
{

    /**
     * Determine if the Stripe model is on trial.
     *
     * @param  string $subscription
     * @param  string|null $plan
     * @return bool
     */
    public function onTrial()
    {
        $subscription = true;
        
        if (func_num_args() === 0 && $this->onGenericTrial()) {
            return true;
        }

        $subscription = $this->subscription($subscription);

        return $subscription && $subscription->onTrial();
    }

    /**
     * Determine if the Stripe model is on a "generic" trial at the model level.
     *
     * @return bool
     */
    public function onGenericTrial()
    {
        return $this->trial_ends_at && Carbon::now()->lt($this->trial_ends_at);
    }

    /**
     * Determine if the Stripe model has a given subscription.
     *
     * @param  string $subscription
     * @param  string|null $plan
     * @return bool
     */
    public function subscribed()
    {
        $subscription = $this->subscription($subscription = true);

        if (is_null($subscription)) {
            return false;
        }

        return $subscription->valid();
    }

    /**
     * Get a subscription instance by name.
     *
     * @param  string $subscription
     * @return \App\AppPaypal|null
     */
    public function subscription($subscription = true)
    {
        return $this->subscriptions->sortByDesc(function ($value) {
            return $value->created_at->getTimestamp();
        })
            ->first(function ($value) use ($subscription) {
                return $value->completed === $subscription;
            });
    }

    /**
     * Get all of the subscriptions for the App model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function subscriptions()
    {
        return $this->hasMany(\App\AppPaypal::class, 'company_app_id')->orderBy('created_at', 'desc');
    }
}