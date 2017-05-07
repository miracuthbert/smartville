<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function galleryable()
    {
        return $this->morphTo();
    }
}
