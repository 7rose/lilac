<?php

namespace App\Helpers;

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
        return $expo->begin->subHours($this->before) > now() ? $expo->begin->subHours($this->before)->diffForHumans() : false;
    }

    /**
     * 会展: 迟
     *
     */
    public function late($expo)
    {
        return $expo->end < now() ? $expo->end->diffForHumans() : false;
    }
}
