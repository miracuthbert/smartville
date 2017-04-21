<?php

namespace App\Models\v1\Estate;

use App\Models\v1\Company\CompanyApp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    protected $table = "app_subscriptions_paypal";
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'trial_ends_at', 'ends_at',
        'created_at', 'updated_at',
    ];

    /**
     * Get Company App Plan
     */
    public function plan()
    {
        return $this->belongsTo(ProductPlan::class, 'payment_plan', 'id');
    }

    /**
     * Get Company App
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

    /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->owner();
    }

    /**
     * Get the model related to the subscription.
     */
    public function owner()
    {
        $model = getenv('PAYPAL_APP_MODEL') ?: config('services.paypalrest.model', 'App\\CompanyApp');

        $model = new $model;

        return $this->belongsTo(get_class($model), $model->getForeignKey());
    }

    /**
     * Determine if the subscription is active, on trial, or within its grace period.
     *
     * @return bool
     */
    public function valid()
    {
        return $this->active() || $this->onTrial();
    }

    /**
     * Determine if the subscription is active.
     *
     * @return bool
     */
    public function active()
    {
        if ($this->completed && !is_null($this->ends_at)) {
            return Carbon::today()->lt($this->ends_at);
        } else {
            return false;
        }
    }

    /**
     * Determine if the subscription is no longer active.
     *
     * @return bool
     */
    public function cancelled()
    {
        return is_null($this->ends_at);
    }

    /**
     * Determine if the subscription is within its trial period.
     *
     * @return bool
     */
    public function onTrial()
    {
        if ($this->completed && !is_null($this->trial_ends_at)) {
            return Carbon::today()->lt($this->trial_ends_at);
        } else {
            return false;
        }
    }

    /**
     * Determine if the subscription is within its grace period after cancellation.
     *
     * @return bool
     */
    public function onGracePeriod()
    {
        if ($this->completed && !is_null($endsAt = $this->ends_at)) {
            return Carbon::now()->lt(Carbon::instance($endsAt));
        } else {
            return false;
        }
    }
}
