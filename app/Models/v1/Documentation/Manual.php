<?php

namespace App\Models\v1\Documentation;

use App\Models\v1\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manual extends Model
{
    use SoftDeletes;

    protected $fillable = ['status', 'index', 'body', 'url', 'title'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the owning manualable models.
     */
    public function manualable()
    {
        return $this->morphTo();
    }

    /**
     * Get Manual Chapters
     */
    public function chapters()
    {
        return $this->hasMany(ManualChapter::class, 'manual_id');
    }

    /**
     * Get Manual Pages
     */
    public function pages()
    {
        return $this->hasManyThrough(ManualChapter::class, ManualPage::class, 'chapter_id', 'manual_id');
    }

}
