<?php

namespace App\Policies;

use App\User;
use App\CompanyUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the companyUser.
     *
     * @param  \App\User  $user
     * @param  \App\CompanyUser  $companyUser
     * @return mixed
     */
    public function view(User $user, CompanyUser $companyUser)
    {
        return $user->id === $companyUser->user_id;
    }

    /**
     * Determine whether the user can create companyUsers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, CompanyUser $companyUser)
    {
        if ($companyUser->user->companyAdmin->status === 1) {
            return $user->id === $companyUser->user_id;
        }
    }

    /**
     * Determine whether the user can update the companyUser.
     *
     * @param  \App\User  $user
     * @param  \App\CompanyUser  $companyUser
     * @return mixed
     */
    public function update(User $user, CompanyUser $companyUser)
    {
        if ($companyUser->user->companyAdmin->status === 1) {
            return $user->id === $companyUser->user_id;
        }
    }

    /**
     * Determine whether the user can delete the companyUser.
     *
     * @param  \App\User  $user
     * @param  \App\CompanyUser  $companyUser
     * @return mixed
     */
    public function delete(User $user, CompanyUser $companyUser)
    {
        if ($companyUser->user->companyAdmin->status === 1) {
            return $user->id === $companyUser->user_id;
        }
    }
}
