<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "categories";

    /**
     * Category
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'categorable');
    }
}
