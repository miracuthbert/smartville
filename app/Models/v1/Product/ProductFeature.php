<?php

namespace App\Models\v1\Product;

use App\Models\Support\BugReport;
use App\Models\v1\Documentation\ManualChapter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFeature extends Model
{
    use SoftDeletes;

    /**
     * Get this feature product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get this feature's manuals
     */
    public function chapters()
    {
        return $this->morphMany(ManualChapter::class, 'featureable');
    }

    /**
     * Get this feature's manuals
     */
    public function bugs()
    {
        return $this->morphMany(BugReport::class, 'buggable');
    }
}
