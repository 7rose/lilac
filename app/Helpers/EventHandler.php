<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class EventHandler
{
    public function handle($payload = null){
        // $message = $server->getMessage();
        Log::info('fuck');
    }

}
