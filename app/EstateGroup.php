<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateGroup extends Model
{
    use SoftDeletes;

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
