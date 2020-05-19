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
        // if(Auth::check()) return $next($request);

        $app = app('wechat.official_account');
        $app['request'] = $request;
        $oauth = $app->oauth->scopes(['snsapi_userinfo']);

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        // $user = $app->oauth->user();
        // $response = $app->oauth->scopes(['snsapi_userinfo']);
        // $app['request'] = $request;

        // print_r($response->user());
        print_r($user);


        // return app(\Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class)->handle($request, function ($request) use ($next) {
        //     $wechat_user = session('wechat.oauth_user.default');
        //     print_r($wechat_user);
        // });

        // return app(middleware())


    }
}
