<?php

namespace App\Http\Controllers;

use App\User;
use App\Rules\Mobile;
use App\Jobs\SendSmsCodeJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * 表单: 手机号
     *
     */
    public function sms()
    {
        if(Auth::check()) return redirect('/me');
        return view('auth.sms');
    }

    /**
     * 获取验证码
     *
     */
    public function code(Request $request)
    {
        $request->validate([
            'mobile' => ['required', new Mobile],
            'terms' => ['accepted'],
        ]);

        $mobile = $request->mobile;

        $rate = 20;
        $code = rand(100000, 999999);
        $send_array = ['mobile'=>$mobile, 'code'=>$code];

        Redis::setex($mobile, 300, $code);
        // SendSmsCodeJob::dispatch($send_array);

        return json_encode(['rate' => $rate]);
    }

    /**
     * 验证
     *
     */
    public function check(Request $request)
    {
        $request->validate([
            'mobile' => ['required', new Mobile],
            'code' => ['required', 'size:6'],
        ]);

        $mobile = $request->mobile;

        if(!Redis::exists($mobile)) return json_encode(['errors' =>['code' => '验证码已过期']]);

        if(Redis::get($mobile)!= $request->code) return json_encode(['errors' =>['code' => '验证码错误']]);

        $user = User::updateOrCreate(
            ['ids->mobile->number' => $mobile],
            [
                'ids->mobile->active' => now(),
                'ids->wechat->id' => Session::has('wechat.oauth_user.default') ? session('wechat.oauth_user.default')->id : null,
                'ids->wechat->info' => Session::has('wechat.oauth_user.default') ? session('wechat.oauth_user.default')->toArray() : null,
            ],
        );

        Auth::login($user);

        $json = json_encode(['success' => 'ok']);

        return $json;
    }

}
