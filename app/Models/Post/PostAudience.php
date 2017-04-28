<?php

namespace App\Models\Post;

use App\Models\v1\Shared\Category;
use Illuminate\Database\Eloquent\Model;

class PostAudience extends Model
{
    /**
     * Get all post audience categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorable');
    }
}
