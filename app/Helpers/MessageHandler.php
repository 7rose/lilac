<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class MessageHandler
{
    /*
     * 消息对象
     */
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
        Log::info('event');
    }
    /*
     * 文本消息响应
     */
    public function textHandler()
    {
        Log::info('text');
    }
}
