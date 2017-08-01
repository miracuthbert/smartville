<?php

namespace App\Models\v1\Company;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyUser extends Model
{
    use SoftDeletes;

    /**
     * Get user details
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get user company app
     */
    public function app()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id');
    }

    /**
     * Get user company disabled apps
     */
    public function appsDisabled()
    {
        return $this->belongsTo(CompanyApp::class, 'company_app_id')->where('company_apps.status', 0);
    }
}
