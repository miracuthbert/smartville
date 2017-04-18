<?php

namespace App\Models\v1\Property;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyPrice extends Model
{
    use SoftDeletes;

    /**
     * Get Price Property
     */
    public function property()
    {
        return $this->belongsTo(EstateProperty::class, 'property_id', 'id');
    }
}
