<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateRent extends Model
{
    use SoftDeletes;

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
