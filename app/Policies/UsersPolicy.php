<?php

namespace App\Policies;

use App\User;
use App\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the users.
     *
     * @param  \App\User  $user
     * @param  \App\Users  $users
     * @return mixed
     */
    public function view(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the users.
     *
     * @param  \App\User  $user
     * @param  \App\Users  $users
     * @return mixed
     */
    public function update(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can delete the users.
     *
     * @param  \App\User  $user
     * @param  \App\Users  $users
     * @return mixed
     */
    public function delete(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can restore the users.
     *
     * @param  \App\User  $user
     * @param  \App\Users  $users
     * @return mixed
     */
    public function restore(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the users.
     *
     * @param  \App\User  $user
     * @param  \App\Users  $users
     * @return mixed
     */
    public function forceDelete(User $user, Users $users)
    {
        //
    }
}
