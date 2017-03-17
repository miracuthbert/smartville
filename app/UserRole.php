<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Get User Details
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
