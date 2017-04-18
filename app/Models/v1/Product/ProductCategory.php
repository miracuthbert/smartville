<?php

namespace App\Models\v1\Product;

use App\Models\v1\Shared\Category;
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
