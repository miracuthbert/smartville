<?php

namespace App\Traits;


use App\AppTrialBuilder;
use App\Models\v1\Company\AppTrial;
use Carbon\Carbon;

trait AppSubscription
{

    public function newSubscription($subscription, $plan)
    {

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
        return $this->trials->first()->trial_ends_at && Carbon::now()->lt($this->trials->first()->trial_ends_at);
    }

    public function subscribed()
    {
        return $this->onTrial() && $this->subscribed;
    }

    public function subscriptions()
    {
        return $this->hasMany(AppTrial::class, 'company_app_id', 'id')->orderBy('created_at', 'DESC');
    }

    /**
     * Cancel the subscription immediately.
     *
     * @return $this
     */
    public function cancelNow()
    {

        // If the user was on trial, we will set the grace period to end when the trial
        // would have ended. Otherwise, we'll retrieve the end of the billing period
        // period and make that the end of the grace period for this current user.
        if ($this->onTrial()) {
            $this->trials()->update(['is_cancelled' => 1]);
        }

        return $this->update(['subscribed' => 0]);
    }

    /**
     * Resume the cancelled subscription.
     * @return $this
     */
    public function resume()
    {
        if (!$this->onGenericTrial()) {
            return false;
        }

        // If the user was on trial, we will set the grace period to end when the trial
        // would have ended. Otherwise, we'll retrieve the end of the billing period
        // period and make that the end of the grace period for this current user.
        if ($this->onTrial()) {
            $this->trials()->update(['is_cancelled' => 0]);
        }

        return $this->update(['is_trial' => 1, 'subscribed' => 1]);
    }

}