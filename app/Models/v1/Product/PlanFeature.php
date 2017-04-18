<?php

namespace App\Models\v1\Product;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    use SoftDeletes;

    /**
     * Get feature's plan
     */
    public function plan()
    {
        return $this->belongsTo(ProductPlan::class);
    }

    /**
     * Get feature's product feature
     */
    public function feature()
    {
        return $this->belongsTo(ProductFeature::class);
    }
}
