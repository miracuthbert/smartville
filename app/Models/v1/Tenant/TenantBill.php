<?php

namespace App\Models\v1\Tenant;

use App\Models\v1\Estate\EstateBill;
use App\Models\v1\Estate\EstateProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantBill extends Model
{
    use SoftDeletes;

    protected $guarded = ['hash'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'date_from', 'date_to', 'date_due'];

    /**
     * Get bill owner app details
     */
    public function app()
    {
        return $this->belongsTo(EstateBill::class, 'bill_id', 'id');
    }

    /**
     * Get bill details
     */
    public function bill()
    {
        return $this->belongsTo(EstateBill::class, 'bill_id', 'id');
    }

    /**
     * Get bill property details
     */
    public function property()
    {
        return $this->belongsTo(EstateProperty::class, 'property_id', 'id');
    }

    /**
     * Get bill lease details
     */
    public function lease()
    {
        return $this->belongsTo(TenantProperty::class, 'tenant_property_id', 'id');
    }
}
