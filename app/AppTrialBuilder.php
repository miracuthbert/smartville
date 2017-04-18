<?php

namespace App;


use App\Models\v1\Company\CompanyApp;
use Carbon\Carbon;

class AppTrialBuilder
{
    /**
     * The app that is subscribing.
     *
     * @var CompanyApp
     */
    protected $app;

    /**
     * The user initiating the app subscription.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $user;

    /**
     * The quantity of the subscription.
     *
     * @var int|null
     */
    protected $quantity;

    /**
     * The number of trial days to apply to the subscription.
     *
     * @var int|null
     */
    protected $trialDays;

    /**
     * Indicates that the trial should end immediately.
     *
     * @var bool
     */
    protected $skipTrial = false;

    /**
     * The metadata to apply to the subscription.
     *
     * @var array|null
     */
    protected $metadata;

    /**
     * AppTrialBuilder constructor.
     * @param $app
     * @param $user
     * @param int $quantity
     * @param int|null $trialDays
     */
    public function __construct($app, $user, $quantity, $trialDays)
    {
        $this->app = $app;
        $this->user = $user;
        $this->quantity = $quantity;
        $this->trialDays = $trialDays;
    }

    /**
     * Specify the quantity of the subscription.
     *
     * @param  int $quantity
     * @return $this
     */
    public function quantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Specify the ending date of the trial.
     *
     * @param  int $trialDays
     * @return $this
     */
    public function trialDays($trialDays)
    {
        $this->trialDays = $trialDays;

        return $this;
    }

    /**
     * Force the trial to end immediately.
     *
     * @return $this
     */
    public function skipTrial()
    {
        $this->skipTrial = true;

        return $this;
    }

    /**
     * The metadata to apply to a new subscription.
     *
     * @param  array $metadata
     * @return $this
     */
    public function withMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Create a new Trial subscription.
     *
     */
    public function create()
    {

        if ($this->skipTrial) {
            $trialEndsAt = null;
        } else {
            $trialEndsAt = $this->trialDays ? Carbon::now()->addDays($this->trialDays) : null;
        }

        return $this->app->trials()->create([
            'user_id' => $this->user->id,
            'quantity' => $this->quantity,
            'trial_ends_at' => $trialEndsAt,
        ]);
    }

}