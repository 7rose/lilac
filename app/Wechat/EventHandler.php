<?php

namespace App\Wechat;

use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Messages\Message;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventHandler implements EventHandlerInterface
{
    protected $message;

    function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function handle($payload = NULL)
    {
        Log::info($this->message);
        return "seccess";
    }

}
