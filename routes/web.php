<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// logs
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

// wechat
Route::any('/wechat', 'WechatController@serve');
Route::any('/wechat/call_back', 'WechatController@callBack');
Route::get('/wechat/init', 'WechatController@init');

// 微信支付回调
Route::any('/pay_callback', 'TicketController@payCallback');

// 退出登录
Route::get('/logout', 'AuthController@logout');

// 默认页
Route::get('/', function () {
    return redirect('/trailer');
});

// 展会预告
Route::get('/trailer', 'ExpoController@trailer');

// wechat user
Route::group(['middleware' => ['web', 'wechat.oauth']], function () {

    Route::get('/sms', 'AuthController@sms');
    Route::post('/code', 'AuthController@code')->middleware('throttle:1,2');
    Route::post('/check', 'AuthController@check')->middleware('throttle:5,5');

    Route::get('/apps', function () {
        return view('apps');
    });

    // auth users
    Route::group(['middleware' => ['mix', 'state']], function () {

        // 微信
        Route::get('/ad', 'WechatController@ad');

        // 用户
        Route::get('/users', 'UserController@index');
        Route::get('/user/{id}', 'UserController@show');
        Route::get('/lock/{id}', 'UserController@lock');
        Route::get('/unlock/{id}', 'UserController@unlock');
        Route::get('/me', 'UserController@me');
        Route::get('/customers', 'UserController@customers'); # 客户
        Route::get('/suppliers', 'UserController@suppliers'); # 供应商
        Route::get('/partners', 'UserController@partners'); # 合作伙伴

        // 机构
        Route::get('/orgs', 'OrgController@index');
        Route::get('/org/create/{id}', 'OrgController@create');
        Route::post('/org/store', 'OrgController@store');

        // 会展
        Route::get('/expos', 'ExpoController@index');
        Route::get('/expo/{id}', 'ExpoController@show');
        Route::post('/expo/allow/{id}', 'ExpoController@allow'); # 开关售票
        Route::get('/expos/create', 'ExpoController@create');
        Route::post('/expos/store', 'ExpoController@store');

        // 票
        Route::get('/pay/{id}', 'TicketController@order');
    });

});

// ------------ dev -------------

Route::get('/fake', 'WechatController@fake');

Route::get('/test', function () {
    $a= "商户系统内部的订单号（$b）";
    $b = "fuck";
    echo $a;
});

Route::get('/in', function () {
    // $user = App\User::find(5);
    $user = App\User::find(6);
    // // $user = App\User::find(1);
    // // $user = App\User::find(8);
    Auth::login($user);
    print_r($user->info);

    // echo '<br>'.Redis::get('17821621090');
    // echo '<br>';
    // $b = Redis::get('oNqBdwRZTz-3T09LrmLGRyQYMsBo');
    // print_r($b);
});

