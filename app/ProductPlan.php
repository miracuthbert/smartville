<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPlan extends Model
{
    use SoftDeletes;

    /**
     * Get plan app
     */
    public function app()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * Get plan features
     */
    public function features()
    {
        return $this->hasMany(PlanFeature::class);
    }
}
