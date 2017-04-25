<?php

namespace App\Models\v1\Tenant;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenantRent extends Model
{
    use SoftDeletes;

    protected $guarded = ['hash'];

    /**
     * @var array $dates
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'date_from', 'date_to', 'date_due'];

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
