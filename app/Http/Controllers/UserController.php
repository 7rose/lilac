<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $app = app('wechat.official_account');
        // $app['request'] = $request;
        $app['request'] = $request;
        $user = $app->oauth->user();

        // 获取 OAuth 授权结果用户信息
        // $user = $oauth->user();
        // $user = $app->oauth->user();
        // $response = $app->oauth->scopes(['snsapi_userinfo']);
        // $app['request'] = $request;

        // print_r($response->user());
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
