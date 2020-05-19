<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $app = app('wechat.official_account');
        // $oauth = $app->oauth->scopes(['snsapi_userinfo']);

        // 获取 OAuth 授权结果用户信息
        // $user = $oauth->user();
        $user = $app->oauth->user();

        print_r($user);
    }


    /**
     * Information of Auth user
     *
     */
    public function me()
    {
        // $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
        return view('user.me');
    }


}
