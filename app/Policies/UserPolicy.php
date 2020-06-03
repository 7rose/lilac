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
    public function viewAll(User $user)
    {
        return $this->auth->need($user, 'staff');
    }

    /**
     * 查看所有用户
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function lockUser(User $user, User $target)
    {
        return $this->auth->win($user, $target) || $user->id == $target->id;
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
     * @param  \App\User  $target
     * @return mixed
     */
    public function update(User $user, User $target)
    {
        return $this->auth->me($user, $target) || $this->auth->fit($user, 'sys', 'admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function delete(User $user, User $target)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function restore(User $user, User $target)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $target
     * @return mixed
     */
    public function forceDelete(User $user, User $target)
    {
        //
    }

    /**
     * 二维码: 展商
     *
     * @return void
     */
    public function customerQrcode(User $user)
    {
        return true;
    }

    /**
     * 二维码: 展商
     *
     * @return void
     */
    public function supplierQrcode(User $user)
    {
        return $this->auth->fit($user, 'market', 'cmo');
    }

    /**
     * 二维码: 展商
     *
     * @return void
     */
    public function partnerQrcode(User $user)
    {
        return $this->auth->fit($user, 'operation', 'coo');
    }
}
