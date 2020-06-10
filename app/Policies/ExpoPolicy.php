<?php

namespace App\Policies;

use App\Expo;
use App\User;
use App\Helpers\Authorize;
use Illuminate\Support\Arr;
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

    /**
     * 检票
     *
     */
    public function checkTicket(User $user, Expo $expo)
    {

        if($this->auth->fit($user, 'operation', 'ticket_leader')) return true;

        $manager = show($expo->conf, 'manager');
        $checker = show($expo->conf, 'checker');

        $m = explode(',', $manager);
        $c = explode(',', $checker);

        $all = array_merge($m, $c);

        if(show($user->ids, 'mobile.number')) {
            $mobile = show($user->ids, 'mobile.number');
            if(in_array($mobile, $all)) return true;
        }

        if(show($user->info, 'nick')) {
            $nick = strtolower(show($user->info, 'nick'));
            if(in_array($nick, $all)) return true;
        }

        return false;
    }


}
