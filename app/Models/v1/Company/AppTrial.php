<?php

namespace App\Models\v1\Company;

use Illuminate\Database\Eloquent\Model;

class AppTrial extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'trial_ends_at', 'ends_at',
        'created_at', 'updated_at',
    ];

    /**
     * Get Trial App
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id', 'id');
    }

}
