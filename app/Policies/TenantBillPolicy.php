<?php

namespace App\Policies;

use App\Models\v1\Tenant\TenantBill;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantBillPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tenantBill.
     *
     * @param  \App\User  $user
     * @param  \App\TenantBill  $tenantBill
     * @return mixed
     */
    public function view(User $user, TenantBill $tenantBill)
    {
        return $user->id === $tenantBill->lease->tenant->user_id;
    }

    /**
     * Determine whether the user can create tenantBills.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the tenantBill.
     *
     * @param  \App\User  $user
     * @param  \App\TenantBill  $tenantBill
     * @return mixed
     */
    public function update(User $user, TenantBill $tenantBill)
    {
        //
    }

    /**
     * Determine whether the user can delete the tenantBill.
     *
     * @param  \App\User  $user
     * @param  \App\TenantBill  $tenantBill
     * @return mixed
     */
    public function delete(User $user, TenantBill $tenantBill)
    {
        //
    }
}
