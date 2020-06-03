<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class EventHandler
{
    public function handle($payload = null, $message){
        // $message = $server->getMessage();
        Log::info($message);
    }

}
