<?php

namespace App\Policies;

use App\User;
use App\Helpers\Authorize;
use App\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    protected $auth;

    function __construct()
    {
        $this->auth = new Authorize;
    }

    /**
     * 读取列表
     *
     * @return void
     */
    public function viewAll(User $user)
    {
        return $this->auth->fit($user, 'operation', 'expo_manager') || $this->auth->fit($user, 'finance', 'finance_manager');
    }

    /**
     * 查看
     *
     */
    public function view(User $user, Ticket $ticket)
    {
        return $this->auth->fit($user, 'operation', 'expo_manager') || $this->auth->fit($user, 'finance', 'finance_manager') || $user->id == $ticket->user_id;
    }
}
