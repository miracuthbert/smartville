<?php

namespace App\Models\Site;

use App\Models\Forum\ForumTopic;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

   protected $cast = [
       'data' => 'array',
   ];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the owner of comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the comment forum.
     */
    public function forum()
    {
        return $this->belongsTo(ForumTopic::class, 'commentable_id');
    }

    /**
     * Get all of the comment's votes.
     */
    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    /**
     * Get all of the comment's helpful votes.
     */
    public function votesLike()
    {
        return $this->morphMany(Vote::class, 'voteable')->where('vote', 1);
    }

    /**
     * Get all of the comment's unhelpful votes.
     */
    public function votesDislike()
    {
        return $this->morphMany(Vote::class, 'voteable')->where('vote', 0);
    }
}
