<?php

namespace App\Http\Controllers;

use App\User;
use App\Jobs\SendSmsCodeJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

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
        $mobile = $request->mobile;

        if($this->isMobile($mobile)) return json_encode(['error' => '手机号不正确']);

        $rate = 60;
        $code = rand(100000, 999999);
        $send_array = ['mobile'=>$request->mobile, 'code'=>$code];

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
        $user = User::find(1);
        Auth::login($user);

        $json = json_encode(['success' => 'ok']);

        return $json;
    }

    /**
     * mobile phone number validator
     *
     */
    private function isMobile($string)
    {
        return preg_match("/^1[345678]\d{9}$/", $string);
    }
}
