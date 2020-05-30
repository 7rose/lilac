<?php

namespace App\Policies;

use App\User;
use App\Helpers\Authorize;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrgPolicy
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
    public function manage(User $user)
    {
        return $this->auth->fit($user, 'sys', 'admin');
    }
}
