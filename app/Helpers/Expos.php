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
        return $expo->begin->subHours($this->before) <= now() && $expo->end >= now();
    }
}
