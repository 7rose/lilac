<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
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

        // $app = app('wechat.official_account');
        // $app['request'] = $request;
        $wechat_user = session('wechat.oauth_user.default');

        print_r($wechat_user);
        $user = User::where('ids->wechat->id', $wechat_user->id)->first();

        if($user) {
            Auth::login($user);
            return $next($request);
        }else{
            return redirect('/sms');
        }

    }
}
