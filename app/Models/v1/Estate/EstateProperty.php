<?php

namespace App\Models\v1\Estate;

use App\Models\Image\Gallery;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Property\PropertyAmenity;
use App\Models\v1\Property\PropertyFeature;
use App\Models\v1\Property\PropertyPrice;
use App\Models\v1\Shared\Category;
use App\Models\v1\Tenant\TenantProperty;
use App\Models\v1\Tenant\TenantRent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateProperty extends Model
{
    use SoftDeletes;

    /**
     * Get Property App
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

    /**
     * Get Property Amenities
     */
    public function amenities()
    {
        return $this->hasMany(PropertyAmenity::class, 'property_id', 'id');
    }

    /**
     * Get Property Features
     */
    public function features()
    {
        return $this->hasMany(PropertyFeature::class, 'property_id', 'id');
    }

    /**
     * Get Property Galleries
     */
    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    /**
     * Get Property Prices
     */
    public function prices()
    {
        return $this->hasMany(PropertyPrice::class, 'property_id', 'id');
    }

    /**
     * Get Property Price
     */
    public function price()
    {
        return $this->hasOne(PropertyPrice::class, 'property_id', 'id')->where('status', 1);
    }

    /**
     * Get Property Group
     */
    public function group()
    {
        return $this->belongsTo(EstateGroup::class, 'property_group', 'id');
    }

    /**
     * Get Property Type
     */
    public function type()
    {
        return $this->belongsTo(Category::class, 'property_type', 'id');
    }

    /**
     * Get Property Tenants
     */
    public function tenants()
    {
        return $this->hasMany(TenantProperty::class, 'property_id', 'id');
    }

    /**
     * Get Property Current Tenant
     */
    public function tenant()
    {
        return $this->hasOne(TenantProperty::class, 'property_id', 'id')->where('status', 1);
    }

    /**
     * Get Property Rent Invoices
     */
    public function rents()
    {
        return $this->hasMany(TenantRent::class, 'property_id', 'id');
    }
}
