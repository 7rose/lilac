<?php

namespace App\Http\Middleware;

use Closure;
use GraphQL\Error\Error;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;


class DeviceIdChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $header = $request->header();
        
        if(Arr::has($header, 'device-id')) return $next($request);

        $error = [
            'message' => '406@device-id can not be founded in headers',
        ];

        return \json_encode($error);  
    }
}
