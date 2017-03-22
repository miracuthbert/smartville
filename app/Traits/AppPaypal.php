<?php

namespace App\Traits;


use App\AppPaypalBuilder;
use App\Models\v1\Estate\Paypal;
use Carbon\Carbon;

trait AppPaypal
{

    /**
     * @param $user
     * @param $paymentId
     * @param $plan
     * @param $quantity
     * @param $hash
     * @param $trialDays
     * @param $months
     * @return AppPaypalBuilder
     */
    public function newSubscription($user, $paymentId, $plan, $quantity, $hash, $trialDays, $months)
    {
        return new AppPaypalBuilder($this, $user, $paymentId, $plan, $quantity, $hash, $trialDays, $months);
    }

    /**
     * @param $user
     * @param $quantity
     * @param $duration
     * @return AppTrialBuilder
     */
    public function newTrial($user, $quantity, $duration)
    {
        return new AppTrialBuilder($this, $user, $quantity, $duration);
    }

    /**
     * @return bool
     */
    public function onTrial()
    {
        if (func_num_args() === 0 && $this->onGenericTrial()) {
            return true;
        }
    }

    /**
     * Determine if the CompanyApp model is on a "generic" trial at the model level.
     * @return bool
     */
    public function onGenericTrial()
    {
        return $this->trials()->trial_ends_at && Carbon::now()->lt($this->trials()->trial_ends_at);
    }

    public function subscribed()
    {
        $endsAt = $this->subscriptions()->first()->ends_at;

        $this->subscriptions()->first()->completed && Carbon::now()->lt($endsAt);
    }

    /**
     * Get the subscription plan by id.
     *
     * @param int|string $subscription
     * @return \Laravel\Cashier\Subscription|null
     */
    public function subscription($subscription = -1)
    {
        $planId = $this->subscriptions()->first()->plan_id;
        
        return $planId;
    }

    public function subscriptions()
    {
        return $this->hasMany(Paypal::class, 'company_app_id', 'id')->orderBy('created_at', 'desc');
    }

}
