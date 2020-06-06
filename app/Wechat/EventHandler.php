<?php

namespace App\Wechat;

use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Messages\Message;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventHandler implements EventHandlerInterface
{
    protected $app;

    function __construct()
    {
        $this->app = app('wechat.official_account');
    }

    public function handle($payload = NULL)
    {
        Log::info($this->app->server->getMessage());
        return "seccess";
    }

}
