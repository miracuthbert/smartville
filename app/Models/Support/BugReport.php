<?php

namespace App\Models\Support;

use App\Models\v1\Product\ProductFeature;
use App\User;
use Illuminate\Database\Eloquent\Model;

class BugReport extends Model
{

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'solved_at'];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get all of the owning commentable models.
     */
    public function buggable()
    {
        return $this->morphTo();
    }

    /**
     * Get report owner.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get report owner.
     */
    public function featureProduct()
    {
        return $this->morphOne(ProductFeature::class, 'featurable_id', 'id');
    }

}
