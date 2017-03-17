<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    /**
     * Get all company apps
     */
    public function apps()
    {
        return $this->hasMany(CompanyApp::class);
    }

    /**
     * Get all company apps
     */
    public function appsTrashed()
    {
        return $this->hasMany(CompanyApp::class)->onlyTrashed();
    }

    /**
     * Get all company users
     */
    public function users()
    {
        return $this->hasMany(CompanyUser::class);
    }

    /**
     * Get company trashed users
     */
    public function usersTrashed()
    {
        return $this->hasMany(CompanyUser::class)->onlyTrashed();
    }

    /**
     * Get Company Logo's/Avatars
     */
    public function avatars()
    {
        return $this->morphMany(Avatar::class, 'avatarable');
    }

    /**
     * Get Company Logo's/Avatar
     */
    public function avatar()
    {
        return $this->morphOne(Avatar::class, 'avatarable')->where('status', 1);
    }
}
