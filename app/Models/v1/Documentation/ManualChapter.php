<?php

namespace App\Models\v1\Documentation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManualChapter extends Model
{
    use SoftDeletes;

    protected $fillable = ['status', 'feature_id', 'index', 'body', 'url', 'title'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get all of the owning features models.
     */
    public function featureable()
    {
        return $this->morphTo();
    }

    /**
     * Get Chapter Manual
     */
    public function manual()
    {
        return $this->belongsTo(Manual::class, 'manual_id');
    }

    /**
     * Get Chapter Pages
     */
    public function pages()
    {
        return $this->hasMany(ManualPage::class, 'chapter_id');
    }
}
