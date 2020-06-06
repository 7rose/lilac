<?php

namespace App\Http\Controllers;

use App\User;
use App\Rules\Mobile;
use Illuminate\Support\Arr;
use App\Jobs\SendSmsCodeJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * 退出登录并删除
     *
     */
    public function logout()
    {
        if(Auth::check()) {
            Auth::user()->update(['ids->wechat' => null]);
            Auth::logout();
        }
    }

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

        $rate = 120;
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

        $updates = ['ids->mobile->active' => now()];

        $wechat_info = session('wechat.oauth_user.default')->toArray();


        if(Redis::exists($wechat_info['id'])) {
            $updates = Arr::add($updates, 'conf', Redis::get($wechat_info['id'])['info']);
            $updates = Arr::add($updates, 'created_by', Redis::get($wechat_info['id'])['created_by']);
        }

        $updates = Arr::add($updates, 'ids->wechat', $wechat_info);

        $user = User::updateOrCreate(
            ['ids->mobile->number' => $mobile],
            $updates,
        );

        if(Redis::exists($mobile)) Redis::del($mobile);
        if(Redis::exists($wechat_info['id'])) Redis::del($wechat_info['id']);

        Auth::login($user);

        return json_encode(['success' => 'ok']);
    }

}
