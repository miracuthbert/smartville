<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactMessage extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone', 'message', 'read_at'];

    protected $dates = ['read_at', 'created_at', 'updated_at', 'deleted_at'];
}
