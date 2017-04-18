<?php

namespace App\Models\v1\Tenant;

use App\Models\v1\Estate\EstateBill;
use App\Models\v1\Estate\EstateProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantBill extends Model
{
    use SoftDeletes;

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
