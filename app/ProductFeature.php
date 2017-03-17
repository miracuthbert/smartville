<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFeature extends Model
{
    use SoftDeletes;

    /**
     * Get this feature product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
