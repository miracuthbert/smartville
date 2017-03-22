<?php

namespace App\Models\Forum;

use App\Models\Site\Comment;
use App\Models\Site\Tag;
use App\Models\Site\Vote;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $fillable = ['status', 'data', 'title', 'details'];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get all of the topic's tags.
     */
    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }

    /**
     * Get all of the topic's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the topic's votes.
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    /**
     * Get topic owner.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
