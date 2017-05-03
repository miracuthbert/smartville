<?php

namespace App\Models\v1\Tenant;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ExtCountries;

class TenantRent extends Model
{
    use SoftDeletes;

    protected $guarded = ['hash'];

    /**
     * @var array $dates
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'date_from', 'date_to', 'date_due', 'paid_at'];

    /**
     * @param $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        $company = $this->property->app->company;
        $country = $company->country;
        $state = $company->state;

        $ctz = ExtCountries::where('name.common', $country)->first()->timezone;

        if (count($ctz) > 1) {
            //get states
            $states = ExtCountries::where('name.common', $country)->first()->states->pluck('name', 'postal');

            //find state
            $state = collect($states)->search($state);

            $ctz = $ctz[$state];
        }

        if ($date != null) {
            $date = Carbon::parse($date);
            $date = $date->setTimezone($ctz);
        }

        return $date;

    }

    /**
     * @param $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        $company = $this->property->app->company;
        $country = $company->country;
        $state = $company->state;

        $ctz = ExtCountries::where('name.common', $country)->first()->timezone;

        if (count($ctz) > 1) {
            //get states
            $states = ExtCountries::where('name.common', $country)->first()->states->pluck('name', 'postal');

            //find state
            $state = collect($states)->search($state);

            $ctz = $ctz[$state];
        }

        if ($date != null) {
            $date = Carbon::parse($date);
            $date = $date->setTimezone($ctz);
        }

        return $date;

    }

    /**
     * @param $date
     * @return string
     */
    public function getDeletedAtAttribute($date)
    {
        $company = $this->property->app->company;
        $country = $company->country;
        $state = $company->state;

        $ctz = ExtCountries::where('name.common', $country)->first()->timezone;

        if (count($ctz) > 1) {
            //get states
            $states = ExtCountries::where('name.common', $country)->first()->states->pluck('name', 'postal');

            //find state
            $state = collect($states)->search($state);

            $ctz = $ctz[$state];
        }

        if ($date != null) {
            $date = Carbon::parse($date);
            $date = $date->setTimezone($ctz);
        }

        return $date;

    }

    /**
     * @param $date
     * @return string
     */
    public function getPaidAtAttribute($date)
    {
        $company = $this->property->app->company;
        $country = $company->country;
        $state = $company->state;

        $ctz = ExtCountries::where('name.common', $country)->first()->timezone;

        if (count($ctz) > 1) {
            //get states
            $states = ExtCountries::where('name.common', $country)->first()->states->pluck('name', 'postal');

            //find state
            $state = collect($states)->search($state);

            $ctz = $ctz[$state];
        }

        if ($date != null) {
            $date = Carbon::parse($date);
            $date = $date->setTimezone($ctz);
        }

        return $date;

    }

    /**
     * @param $date
     * @return string
     */
    public function getDateDueAttribute($date)
    {
        $company = $this->property->app->company;
        $country = $company->country;
        $state = $company->state;

        $ctz = ExtCountries::where('name.common', $country)->first()->timezone;

        if (count($ctz) > 1) {
            //get states
            $states = ExtCountries::where('name.common', $country)->first()->states->pluck('name', 'postal');

            //find state
            $state = collect($states)->search($state);

            $ctz = $ctz[$state];
        }

        if ($date != null) {
            $date = Carbon::parse($date);
            $date = $date->setTimezone($ctz);
        }

        return $date;

    }

    /**
     * @param $date
     * @return string
     */
    public function getDateFromAttribute($date)
    {
        $company = $this->property->app->company;
        $country = $company->country;
        $state = $company->state;

        $ctz = ExtCountries::where('name.common', $country)->first()->timezone;

        if (count($ctz) > 1) {
            //get states
            $states = ExtCountries::where('name.common', $country)->first()->states->pluck('name', 'postal');

            //find state
            $state = collect($states)->search($state);

            $ctz = $ctz[$state];
        }

        if ($date != null) {
            $date = Carbon::parse($date);
            $date = $date->setTimezone($ctz);
        }

        return $date;

    }

    /**
     * @param $date
     * @return string
     */
    public function getDateToAttribute($date)
    {
        $company = $this->property->app->company;
        $country = $company->country;
        $state = $company->state;

        $ctz = ExtCountries::where('name.common', $country)->first()->timezone;

        if (count($ctz) > 1) {
            //get states
            $states = ExtCountries::where('name.common', $country)->first()->states->pluck('name', 'postal');

            //find state
            $state = collect($states)->search($state);

            $ctz = $ctz[$state];
        }

        if ($date != null) {
            $date = Carbon::parse($date);
            $date = $date->setTimezone($ctz);
        }

        return $date;

    }

    /**
     * Get Rent App
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

    /**
     * Get rent property details
     */
    public function property()
    {
        return $this->belongsTo(EstateProperty::class, 'property_id', 'id');
    }

    /**
     * Get rent lease details
     */
    public function lease()
    {
        return $this->belongsTo(TenantProperty::class, 'tenant_property_id', 'id');
    }
}
