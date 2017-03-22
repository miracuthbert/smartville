<?php

namespace App\Models\Site;

use App\Models\Forum\ForumTopic;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'user_id'];

    /**
     * Get all of the owning commentable models.
     */
    public function taggable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forums() {
        return $this->belongsTo(ForumTopic::class, 'taggable_id');
    }
}
