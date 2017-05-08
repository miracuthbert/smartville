<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the owning photoable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable()
    {
        return $this->morphTo();
    }
}
