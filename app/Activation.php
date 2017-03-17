<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    public function activateable() {
        return $this->morphTo();
    }
}
