<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyAmenity extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['amenity_id, property_id, status'];

    /**
     * Get amenity details
     */
    public function amenity()
    {
        return $this->belongsTo(Amenity::class, 'amenity_id');
    }
}
