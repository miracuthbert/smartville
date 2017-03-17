<?php

namespace App\Policies;

use App\User;
use App\Tenant;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tenant.
     *
     * @param  \App\User  $user
     * @param  \App\Tenant  $tenant
     * @return mixed
     */
    public function view(User $user, Tenant $tenant)
    {
        return $user->id === $tenant->user_id;
    }

    /**
     * Determine whether the user can create tenants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the tenant.
     *
     * @param  \App\User  $user
     * @param  \App\Tenant  $tenant
     * @return mixed
     */
    public function update(User $user, Tenant $tenant)
    {
        //
    }

    /**
     * Determine whether the user can delete the tenant.
     *
     * @param  \App\User  $user
     * @param  \App\Tenant  $tenant
     * @return mixed
     */
    public function delete(User $user, Tenant $tenant)
    {
        //
    }
}
