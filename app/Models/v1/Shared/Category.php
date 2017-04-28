<?php

namespace App\Models\v1\Shared;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;


    /**
     * Overrides default guarded
     * Makes all attributes fillable
     *
     * @var array $guarded
     */
    protected $guarded = [];

    /**
     * Override default dates
     *
     * @var array $dates
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the owning categorable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function categorable()
    {
        return $this->morphTo();
    }
}
