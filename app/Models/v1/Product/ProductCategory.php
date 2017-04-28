<?php

namespace App\Models\v1\Product;

use App\Models\v1\Shared\Category;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "categories";

    /**
     * Get all of the owning categorable models.
     */
    public function categorable()
    {
        return $this->hasOne(Category::class, 'categorable');
    }
}
