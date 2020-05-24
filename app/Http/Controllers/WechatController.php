<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "海上牧云欢迎您!";
        });

        return $app->server->serve();
    }

    public function callBack()
    {
        //
    }


    public function ad()
    {
        $app = app('wechat.official_account');
        $reasult = $app->qrcode->temporary('ad_'.Auth::id(), 3000);
        $url = $reasult['url'];

        return view('ad',compact('url'));
    }
}
