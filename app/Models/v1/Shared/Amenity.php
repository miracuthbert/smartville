<?php

namespace App\Models\v1\Shared;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Property\PropertyAmenity;
use App\Traits\Eloquent\OrderableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use SoftDeletes, OrderableTrait;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get Amenity App.
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

    /**
     * Get Amenity Properties
     */
    public function properties()
    {
        return $this->belongsToMany(EstateProperty::class, 'property_amenities', 'amenity_id', 'property_id')->withTimestamps();
    }

    /**
     * Get Amenity Property.
     *
     * @param EstateProperty $property
     * @return mixed
     */
    public function property(EstateProperty $property)
    {
        return $this->properties()->wherePivot('property_id', $property->id)->withTimestamps()->first();
    }
}
