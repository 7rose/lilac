<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MixAuth
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
        if(Auth::check()) return $next($request);


        return app(\Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class)->handle($request, function ($request) use ($next) {
            $wechat_user = session('wechat.oauth_user.default');
            print_r($wechat_user);
        });


    }
}
