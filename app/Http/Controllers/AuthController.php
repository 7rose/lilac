<?php

namespace App\Http\Controllers;

use App\User;
use App\Jobs\SendSmsCodeJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    /**
     * 表单: 手机号
     *
     */
    public function sms()
    {
        return view('auth.sms');
    }

    /**
     * 获取验证码
     *
     */
    public function code(Request $request)
    {
        $mobile = $request->mobile;
        $code = rand(100000, 999999);

        Redis::setex($mobile, 300, $code);

        $send_array = ['mobile'=>$mobile, 'code'=>$code];


        // SendSmsCodeJob::dispatch($send_array);

        // $ex = User::where('ids->mobile->number',$mobile)->first();

        // print_r($send_array);

        // $fake = ['exsists' => $ex ? true: false, 'success' => true];

        // return $fake;
        return view('auth.check');
    }
}
