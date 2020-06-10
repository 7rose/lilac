<?php

namespace App\Policies;

use App\User;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpoPolicy
{
    use HandlesAuthorization;

    protected $auth;

    function __construct()
    {
        $this->auth = new Authorize;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function create(User $user)
    {
        return $this->auth->fit($user, 'operation', 'expo_manager');
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewAll(User $user)
    {
        return $this->auth->need($user, 'staff');
    }


}
