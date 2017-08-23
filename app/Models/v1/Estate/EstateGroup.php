<?php

namespace App\Models\v1\Estate;

use App\Models\v1\Company\CompanyApp;
use App\Traits\Eloquent\OrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateGroup extends Model
{
    use SoftDeletes, OrderableTrait;

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get Group App
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

    /**
     * Get Group Properties
     */
    public function properties()
    {
        return $this->hasMany(EstateProperty::class, 'property_group', 'id');
    }

    /**
     * Get Group Occupied Properties
     */
    public function occupiedProperties()
    {
        return $this->hasMany(EstateProperty::class, 'property_group', 'id')->where('status', 1);
    }
}
