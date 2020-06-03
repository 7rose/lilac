<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class EventHandler
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }
    /*
     * 事件响应函数
     */
    public function eventHandler()
    {
        // return new Text(['content' => "指令已收到！"]);
        Log::info($this->message);
    }

}
