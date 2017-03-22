<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $fillable = ['vote', 'user_id', 'voteable_id', 'voteable_type'];

    /**
     * Get all of the owning voteable models.
     */
    public function voteable()
    {
        return $this->morphTo();
    }
}
