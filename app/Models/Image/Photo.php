<?php

namespace App\Models\Image;

use App\Models\v1\Shared\Category;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get all of the owning photoable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable()
    {
        return $this->morphTo();
    }

    /**
     * Get photo audience details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audience()
    {
        return $this->belongsTo(Category::class, 'audience_id', 'id');
    }
}
