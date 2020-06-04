<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class EventHandler
{

    public function handle($payload = null)
    {
        // return new Text(['content' => "指令已收到！"]);
        Log::info($this->message);
    }

}
