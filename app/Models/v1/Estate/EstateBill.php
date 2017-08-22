<?php

namespace App\Models\v1\Estate;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Tenant\TenantBill;
use App\Traits\Eloquent\OrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateBill extends Model
{
    use SoftDeletes, OrderableTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get active bill service(s).
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Get not active bill service(s).
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsNotActive($query)
    {
        return $query->where('status', false);
    }

    /**
     * Get Bill App
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

    /**
     * Get Bill Service related Tenant Bills
     */
    public function tenantBills()
    {
        return $this->hasMany(TenantBill::class, 'bill_id', 'id');
    }

}
