<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * Get this product's category model
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get this product's monetization model
     */
    public function monetization()
    {
        return $this->belongsTo(Category::class, 'monetization_id', 'id');
    }

    /**
     * Get this product's features
     */
    public function features()
    {
        return $this->hasMany(ProductFeature::class);
    }

    /**
     * Get this product's features in trash
     */
    public function featuresTrashed()
    {
        return $this->hasMany(ProductFeature::class)->onlyTrashed();
    }

    /**
     * Get product's plans
     */
    public function plans()
    {
        return $this->hasMany(ProductPlan::class);
    }

    /**
     * Get product's plans
     */
    public function plansActive()
    {
        return $this->hasMany(ProductPlan::class)->where('product_plans.status', 1);
    }

    /**
     * Get product's plans in trash
     */
    public function plansTrashed()
    {
        return $this->hasMany(ProductPlan::class)->onlyTrashed();
    }

    /**
     * Get product's companies
     */
    public function companies()
    {
        return $this->hasMany(CompanyApp::class, 'product_id');
    }
}
