<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity extends Model
{
    use SoftDeletes;

    /**
     * Get Amenity App
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
        return $this->hasMany(PropertyAmenity::class, 'amenity_id', 'id');
    }
}
