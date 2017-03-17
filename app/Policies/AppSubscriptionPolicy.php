<?php

namespace App\Policies;

use App\User;
use App\AppSubscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppSubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the appSubscription.
     *
     * @param  \App\User  $user
     * @param  \App\AppSubscription  $appSubscription
     * @return mixed
     */
    public function view(User $user, AppSubscription $appSubscription)
    {
        //
    }

    /**
     * Determine whether the user can create appSubscriptions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the appSubscription.
     *
     * @param  \App\User  $user
     * @param  \App\AppSubscription  $appSubscription
     * @return mixed
     */
    public function update(User $user, AppSubscription $appSubscription)
    {
        //
    }

    /**
     * Determine whether the user can delete the appSubscription.
     *
     * @param  \App\User  $user
     * @param  \App\AppSubscription  $appSubscription
     * @return mixed
     */
    public function delete(User $user, AppSubscription $appSubscription)
    {
        //
    }
}
