<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes;

    /**
     * Get User Details
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get Tenant App Details
     */
    public function company()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

    /**
     * Get Tenant's Properties Leased Details
     */
    public function leases()
    {
        return $this->hasMany(TenantProperty::class, 'tenant_id', 'id');
    }

    /**
     * Get Tenant's Rent details
     */
    public function rents()
    {
        return $this->hasManyThrough(TenantRent::class, TenantProperty::class, 'tenant_id', 'tenant_property_id');
    }

    /**
     * Get Tenant's Bills details
     */
    public function bills()
    {
        return $this->hasManyThrough(TenantBill::class, TenantProperty::class, 'tenant_id', 'tenant_property_id');
    }

    /**
     * Get Tenant Property LeaseIn Details
     */
    public function leaseIn()
    {
        return $this->hasMany(TenantProperty::class, 'tenant_id', 'id')->where('status', 1);
    }

}
