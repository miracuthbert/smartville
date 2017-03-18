<?php

namespace App;

use App\Traits\AppSubscribed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CompanyApp extends Model
{
    use SoftDeletes, AppSubscribed, Notifiable;

    protected $fillable = ['status', 'subscribed'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get app paypal subscription
     */
    public function paypal()
    {
        return $this->hasMany(AppPaypal::class, 'company_app_id');
    }

    /**
     * Get app company's
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Get company's app product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Get company's app amenities
     */
    public function amenities()
    {
        return $this->hasMany(Amenity::class, 'company_app_id', 'id');
    }

    /**
     * Get company's app billing services
     */
    public function billingServices()
    {
        return $this->hasMany(EstateBill::class, 'company_app_id', 'id');
    }

    /**
     * Get company's app amenities trashed
     */
    public function amenitiesTrashed()
    {
        return $this->hasMany(Amenity::class, 'company_app_id')->onlyTrashed();
    }

    /**
     * Get company's app groups
     */
    public function groups()
    {
        return $this->hasMany(EstateGroup::class, 'company_app_id', 'id');
    }

    /**
     * Get company's app groups trashed
     */
    public function groupsTrashed()
    {
        return $this->hasMany(EstateGroup::class, 'company_app_id')->onlyTrashed();
    }

    /**
     * Get company's app properties
     */
    public function properties()
    {
        return $this->hasMany(EstateProperty::class, 'company_app_id', 'id');
    }

    /**
     * Get company's app properties trashed
     */
    public function propertiesTrashed()
    {
        return $this->hasMany(EstateProperty::class, 'company_app_id')->onlyTrashed();
    }

    /**
     * Get company's app tenants
     */
    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'company_app_id', 'id');
    }

    /**
     * Get company's app tenants trashed
     */
    public function tenantsTrashed()
    {
        return $this->hasMany(Tenant::class, 'company_app_id')->onlyTrashed();
    }

    /**
     * Get company's app tenants leases trashed
     */
    public function leasesTrashed()
    {
        return $this->hasManyThrough(TenantProperty::class, Tenant::class, 'company_app_id', 'tenant_id')->onlyTrashed();
    }

    /**
     * Get company's app rents
     */
    public function rents()
    {
        return $this->hasManyThrough(TenantRent::class, EstateProperty::class, 'company_app_id', 'property_id');
    }

    /**
     * Get company's app bills
     */
    public function bills()
    {
        return $this->hasManyThrough(TenantBill::class, EstateProperty::class, 'company_app_id', 'property_id');
    }
}
