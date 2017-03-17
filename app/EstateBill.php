<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstateBill extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at, updated_at, deleted_at'];

    /**
     * Get Bill App
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

}
