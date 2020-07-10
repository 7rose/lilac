<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Helpers\Authorize;
use Illuminate\Support\Facades\Auth;

class Expos
{
    protected $before = 2; # 提前2小时

    /**
     * 票: 可检票
     *
     */
    public function checkable($ticket)
    {
        return $this->ready($ticket->expo);
    }

    /**
     * 会展: 就绪
     *
     */
    public function ready($expo)
    {
        return !$this->early($expo) && !$this->late($expo);
    }

    /**
     * 会展: 早
     *
     */
    public function early($expo)
    {
        $begin = Carbon::parse($expo->begin)->subHours($this->before) ;
        return $begin > now() ? $begin->diffForHumans() : false;
    }

    /**
     * 会展: 迟
     *
     */
    public function late($expo)
    {
        $end = Carbon::parse($expo->end);
        return $end < now() ? $end->diffForHumans() : false;
    }

    /**
     * 可以买票
     *
     */
    public function buy($expo)
    {
        // 人数
        $limit = intval(show($expo->info, 'limit'));
        $sold = $expo->tickets->count();
        if($limit < 1 || $sold >= $limit) return false;
        // echo $limit;

        // 时间
        $ready_for_ticket = Carbon::parse(show($expo->info, 'ready'));
        if($this->late($expo)) return false;

        // 允许员工购买
        $au = new Authorize;
        if($ready_for_ticket > now() && (!Auth::check() || !$au->need(Auth::user(), 'staff'))) return false;

        $rest = $limit - $sold;

        return $rest > 0 ? $rest : false;
    }    
}
