<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
