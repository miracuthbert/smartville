<?php

namespace App\Models\v1\Shared;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function categorable()
    {
        return $this->morphTo();
    }
}
