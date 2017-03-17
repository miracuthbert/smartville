<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyFeature extends Model
{
    use SoftDeletes;

    /**
     * Get Feature Property
     */
    public function property()
    {
        return $this->belongsTo(EstateProperty::class, 'property_id', 'id');
    }

    /**
     * Get Feature Amenity
     */
    public function amenity()
    {
        return $this->belongsTo(Amenity::class, 'amenity_id', 'id');
    }

}
