<?php

namespace App;

use App\Models\Forum\ForumTopic;
use App\Models\Support\BugReport;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Company\CompanyUser;
use App\Models\v1\Tenant\Tenant;
use App\Models\v1\Upload\Avatar;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Cashier\Billable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable, Billable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'phone', 'country', 'email', 'password', 'activated', 'id_no', 'last_login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['last_login_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    /**
     * User App Payment
     */
    public function appPaypal()
    {
        return $this->hasMany(AppPaypal::class, 'user_id');
    }

    /**
     * User Roles
     */
    public function roles()
    {
        return $this->hasMany(UserRole::class);
    }

    /**
     * User Activated
     */
    public function activated()
    {
        return $this->morphOne(Activation::class, 'activateable');
    }

    /**
     * Root Role
     */
    public function root()
    {
        return $this->hasOne(UserRole::class)->where('role_id', 1);
    }

    /**
     * Admin Role
     */
    public function admin()
    {
        return $this->hasOne(UserRole::class)->where('role_id', 2);
    }

    /**
     * Company App Admin
     */
    public function companyAppAdmin()
    {
        return $this->hasOne(UserRole::class)->where('role_id', 5);
    }

    /**
     * Company Admin Role
     */
    public function companyAdmin()
    {
        return $this->hasOne(UserRole::class)->where('role_id', 3);
    }

    /**
     * Tenant Role
     */
    public function tenant()
    {
        return $this->hasOne(UserRole::class)->where('role_id', 4);
    }

    /**
     * Tenanies
     */
    public function tenancies()
    {
        return $this->hasMany(Tenant::class, 'user_id', 'id');
    }

    /**
     * Get User Companies
     */
    public function companies()
    {
        return $this->hasMany(CompanyUser::class, 'user_id')->where('status', 1);
    }

    /**
     * Get User Apps
     */
    public function apps()
    {
        return $this->hasManyThrough(CompanyApp::class, CompanyUser::class, 'user_id', 'company_id', 'id');
    }

    /**
     * Get User Apps Active
     */
    public function activeApps()
    {
        return $this->hasManyThrough(CompanyApp::class, CompanyUser::class, 'user_id', 'company_id', 'id')->where('company_apps.status', 1);
    }

    /**
     * Get User Disabled Apps
     */
    public function disabledApps()
    {
        return $this->hasManyThrough(CompanyApp::class, CompanyUser::class, 'user_id', 'company_id', 'id')->where('company_apps.status', 0);
    }

    /**
     * Get User Trashed Apps
     */
    public function trashedApps()
    {
        return $this->hasManyThrough(CompanyApp::class, CompanyUser::class, 'user_id', 'company_id', 'id')->onlyTrashed('company_apps');
    }

    /**
     * Get User's Logos/Avatars
     */
    public function avatars()
    {
        return $this->morphMany(Avatar::class, 'avatarable');
    }

    /**
     * Get User's Logo/Avatar
     */
    public function avatar()
    {
        return $this->morphOne(Avatar::class, 'avatarable')->where('status', 1);
    }

    /**
     * Get User's Forums
     */
    public function forums()
    {
        return $this->hasMany(ForumTopic::class, 'user_id');
    }

    /**
     * Get User's Bug Reports
     */
    public function bugs()
    {
        return $this->hasMany(BugReport::class, 'user_id');
    }
}
