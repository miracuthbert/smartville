<?php

namespace App\Models\v1\Documentation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManualPage extends Model
{
    use SoftDeletes;

    protected $fillable = ['status', 'index', 'body', 'url', 'title'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    /**
     * Get Page Chapter
     */
    public function chapter()
    {
        return $this->belongsTo(ManualChapter::class, 'chapter_id');
    }

}
