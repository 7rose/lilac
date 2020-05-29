<?php

namespace App\Policies;

use App\User;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    protected $auth;

    function __construct()
    {
        $this->auth = new Authorize;
    }

    /**
     * 查看所有用户
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewUsers(User $user)
    {
        return $this->auth->need($user, 'staff');
    }

    /**
     * 查看所有用户
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function lockUsers(User $user, $id)
    {
        return $this->auth->fit($user, 'operation', 'ad_manager');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
