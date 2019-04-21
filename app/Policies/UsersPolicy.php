<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $users
     * @return mixed
     */
    public function view(User $user, User $users)
    {
        return true;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->type == 'Super Admin')
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $users
     * @return mixed
     */
    public function update(User $user, User $users)
    {
        if($user->type == 'Super Admin' || $user->id == $users->id)
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $users
     * @return mixed
     */
    public function delete(User $user, User $users)
    {
        if($user->type == 'Super Admin' || $user->id == $users->id)
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $users
     * @return mixed
     */
    public function restore(User $user, User $users)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the users.
     *
     * @param  \App\User  $user
     * @param  \App\User  $users
     * @return mixed
     */
    public function forceDelete(User $user, User $users)
    {
        if($user->type == 'Super Admin')
        {
            return true;
        }
        return false;
    }
}
