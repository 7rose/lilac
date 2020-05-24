<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * 授权
     *
     */
    public function authorize(User $user) {
        //
    }

    /**
     * 锁止
     *
     */
    public function lock(User $user) {
        $user->orgs();
    }


}
