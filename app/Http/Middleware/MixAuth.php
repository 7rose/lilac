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

        $wechat_user = session('wechat.oauth_user.default');
        $user = User::where('ids->wechat->id', $wechat_user->id)->first();

        if($user) {
            Auth::login($user);
            return $next($request);
        }else{
            return redirect('/sms');
        }

    }
}
