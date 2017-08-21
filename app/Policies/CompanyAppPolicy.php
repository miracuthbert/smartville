<?php

namespace App\Policies;

use App\User;
use App\Models\v1\Company\CompanyApp;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyAppPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the companyApp.
     *
     * @param  \App\User $user
     * @param CompanyApp $companyApp
     * @return mixed
     */
    public function view(User $user, CompanyApp $companyApp)
    {
        $app = $user->companies()->where('company_app_id', $companyApp->id)->first();

        return $app->company_app_id === $companyApp->id;
    }

    /**
     * Determine whether the user can create companyApps.
     *
     * @param  \App\User $user
     * @param CompanyApp $companyApp
     * @return mixed
     */
    public function create(User $user, CompanyApp $companyApp)
    {
        return $this->touch($user, $companyApp);
    }

    /**
     * Determine whether the user can update the companyApp.
     *
     * @param  \App\User $user
     * @param CompanyApp $companyApp
     * @return mixed
     */
    public function update(User $user, CompanyApp $companyApp)
    {
        return $this->touch($user, $companyApp);
    }

    /**
     * Determine whether the user can delete the companyApp.
     *
     * @param  \App\User $user
     * @param CompanyApp $companyApp
     * @return mixed
     */
    public function delete(User $user, CompanyApp $companyApp)
    {
        return $this->touch($user, $companyApp);
    }

    /**
     * Determine whether the user can take action on the companyApp.
     *
     * @param  \App\User $user
     * @param CompanyApp $companyApp
     * @return mixed
     */
    public function touch(User $user, CompanyApp $companyApp)
    {
        $app = $user->companies()->where('company_app_id', $companyApp->id)->first();

        $admin = $user->companyAppAdmin() ? $user->companyAppAdmin->admin : '';

        return $app->company_app_id === $companyApp->id;
    }
}
