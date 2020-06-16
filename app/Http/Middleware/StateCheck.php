<?php

namespace App\Http\Middleware;

use Closure;
use App\Expo;
use App\Helpers\Authorize;
use Illuminate\Support\Facades\Auth;

class StateCheck
{
    protected $menu, $checker;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()) return redirect('/sms');

        $user = Auth::user();

        if($user->locked) abort('423');

        // $apps = [
        //     [
        //         "type" => "view",
        //         "name" => "应用",
        //         "url"  => "https://wechat.mooibay.com/apps",
        //     ],
        // ];

        // // $this->app->menu->create($buttons);

        // // 扫码
        // $scan = [
        //     "type" => "scancode_push",
        //     "name" => "扫一扫",
        //     "key"  => "wechat_menu",
        // ];

        // // 我
        // $me = [
        //     "type" => "view",
        //     "name" => "我",
        //     "url"  => "https://wechat.mooibay.com/me",
        // ];

        // // 会展预告
        // $expo = [
        //     "name"       => "会展",
        //     "sub_button" => [
        //         [
        //             "type" => "view",
        //             "name" => "购票",
        //             "url"  => "https://wechat.mooibay.com/trailer",
        //         ],
        //         [
        //             "type" => "view",
        //             "name" => "联系我们",
        //             "url"  => "https://wechat.mooibay.com/contact",
        //         ],
        //     ],
        // ];

        // $auth = new Authorize;

        // $this->menu = [$expo, $me];

        // $this->checker = false;

        // // 员工
        // if($auth->need($user, 'staff')){
        //     $this->menu = [$scan, $apps, $me];
        // }else{
        //     $ready_expos = Expo::where('begin', '<', now()->addHour(2))
        //                         ->get();

        //     foreach ($ready_expos as $expo) {
        //         if(show($expo->conf, 'manager')) {
        //             $user_array = explode(',', show($expo->conf, 'manager'));
        //             if(in_array($user->ids->mobile->number, $user_array)) $this->checker = true;
        //             if(show($user->info, 'nick') && in_array(show($user->info, 'nick'), $user_array)) $this->checker = true;
        //         }
        //         if(show($expo->conf, 'checker')) {
        //             $user_array = explode(',', show($expo->conf, 'checker'));
        //             if(in_array($user->ids->mobile->number, $user_array)) $this->checker = true;
        //             if(show($user->info, 'nick') && in_array(show($user->info, 'nick'), $user_array)) $this->checker = true;
        //         }
        //         //
        //         if($this->checker) $this->menu[] = $scan;
        //     }
        // }

        return $next($request);
    }
}
