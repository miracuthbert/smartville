<?php

namespace App\Models\v1\Upload;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = ['status', 'data', 'name', 'type'];

    protected $dates = ['updated_at', 'created_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get all of the owning avatarable models.
     */
    public function avatarable()
    {
        return $this->morphTo();
    }
}
