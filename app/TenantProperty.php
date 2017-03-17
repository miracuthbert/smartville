<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantProperty extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at, updated_at, deleted_at, move_in, move_out'];

    /**
     * Get tenant details
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    /**
     * Get leased property details
     */
    public function property()
    {
        return $this->belongsTo(EstateProperty::class, 'property_id', 'id');
    }

    /**
     * Get lease rent details
     */
    public function rents()
    {
        return $this->hasMany(TenantRent::class, 'tenant_property_id', 'id');
    }

    /**
     * Get lease bills details
     */
    public function bills()
    {
        return $this->hasMany(TenantBill::class, 'tenant_property_id', 'id');
    }
}
