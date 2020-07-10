<?php

namespace App\Helpers;

use Carbon\Carbon;

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
     * 会展: 迟
     *
     */
    public function buy($expo)
    {
        $limit = intval(show($expo->info, 'limit'));
        if($limit < 1) return false;

        $end = Carbon::parse($expo->end);
        return $end < now() ? $end->diffForHumans() : false;
    }    
}
