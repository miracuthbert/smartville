<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the owning galleryable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function galleryable()
    {
        return $this->morphTo();
    }

    /**
     * Get all photos' of gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    /**
     * Get all public photos of gallery
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function publicPhotos()
    {
        return $this->morphMany(Photo::class, 'photoable')->where('status', 1)
            ->where('pivot.slug', 'post-audiences-public');
    }
}
