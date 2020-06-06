<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventHandler implements EventHandlerInterface
{

    public function handle($payload = NULL)
    {
        // return new Text(['content' => "指令已收到！"]);
        return "seccess";
        Log::info('fnk');
    }

}
