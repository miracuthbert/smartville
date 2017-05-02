<?php

namespace App\Models\v1\Property;

use App\Models\v1\Estate\EstateGroup;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * Get property's group
     */
    public function group()
    {
        return $this->belongsTo(EstateGroup::class, 'property_group', 'id');
    }

    /**
     * Get property's group
     */
    public function features()
    {
        return $this->hasMany(PropertyFeature::class, 'property_id', 'id');
    }

    /**
     * Get property's amenities
     */
    public function amenities()
    {
        return $this->hasMany(PropertyAmenity::class, 'property_id', 'id');
    }


}
