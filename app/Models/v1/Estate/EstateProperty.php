<?php

namespace App\Models\v1\Estate;

use App\Models\Image\Gallery;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Property\PropertyAmenity;
use App\Models\v1\Property\PropertyFeature;
use App\Models\v1\Property\PropertyPrice;
use App\Models\v1\Shared\Amenity;
use App\Models\v1\Shared\Category;
use App\Models\v1\Tenant\TenantProperty;
use App\Models\v1\Tenant\TenantRent;
use App\Traits\Eloquent\OrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateProperty extends Model
{
    use SoftDeletes, OrderableTrait;

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
        return $this->belongsToMany(Amenity::class, 'property_amenities', 'property_id', 'amenity_id')->withTimestamps()
            ->withPivot(['deleted_at']);
    }

    /**
     * Get Property Amenity
     * @param Amenity $amenity
     * @return
     */
    public function amenable(Amenity $amenity)
    {
        return $this->amenities->contains($amenity);
    }

    /**
     * @param Amenity $amenity
     * @return mixed
     *
     * TODO: Move method to Amenity model to prevent query duplicates.
     */
    public function amenity(Amenity $amenity)
    {
        return $this->amenities()->wherePivot('amenity_id', $amenity->id)->withTimestamps()->first();
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

    public function user()
    {
        return $this->user;
    }

    /**
     * Get Property Rent Invoices
     */
    public function rents()
    {
        return $this->hasMany(TenantRent::class, 'property_id', 'id');
    }
}
