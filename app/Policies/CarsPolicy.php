<?php

namespace App\Policies;

use App\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Policy for deletion of item.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->is_admin == true;
        // if ($user->is_admin === true) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Policy for editition item.
     *
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->is_admin == true;
        // if ($user->is_admin === true) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Policy for creation item.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->is_admin == true;
        // if ($user->is_admin == true) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    /**
     * Policy for view API.
     *
     * @param User $user
     * @return bool
     */
    public function viewAPI(User $user)
    {
        // return true;
        return $user->is_admin == true;
    }
}
