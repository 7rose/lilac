<?php

use App\User;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use function EasyWeChat\Kernel\Support\str_random;

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

// sms
Route::get('/sms', 'AuthController@sms');
Route::post('/code', 'AuthController@code')->middleware('throttle:1,2');
Route::post('/check', 'AuthController@check')->middleware('throttle:5,5');
Route::get('/logout', 'AuthController@logout');

Route::get('/', function () {
    return view('welcome');
});

// wechat user
// Route::group(['middleware' => ['web', 'wechat.oauth']], function () {

    Route::get('/apps', function () {
        return view('apps');
    });


    // auth users
    // Route::get('/expos', 'UserController@index');
    Route::group(['middleware' => ['mix']], function () {
        Route::get('/ad', 'WechatController@ad');
        Route::get('/users', 'UserController@index');
        Route::get('/user/{id}', 'UserController@show');
        Route::get('/me', 'UserController@me');
        Route::post('/pub', 'SettingController@pub');
    });

// });

Route::get('/test', function () {
    abort('403');
    // $a = Auth::login(User::find(5));
    // $a = User::find(5)->roles()->pluck('key');
    // print_r($a);
    // print_r(Arr::flatten($a));
    // print_r($a->key);
    // foreach($a as $item)
    // {
    //     echo $item->key;
    // }
    // $a = User::find(4)->ids;

    // print_r(show($a, 'wechat.nickname'));
});

