<?php

use App\User;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use function EasyWeChat\Kernel\Support\str_random;
use function GuzzleHttp\json_decode;

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

// 展会预告
Route::get('/expos/now', 'ExpoController@index');

// wechat user
// Route::group(['middleware' => ['web', 'wechat.oauth']], function () {

    Route::get('/apps', function () {
        return view('apps');
    });

    // auth users
    Route::group(['middleware' => ['mix']], function () {

        Route::get('/ad', 'WechatController@ad');
        Route::get('/users', 'UserController@index');
        Route::get('/user/{id}', 'UserController@show');
        Route::get('/lock/{id}', 'UserController@lock');
        Route::get('/unlock/{id}', 'UserController@unlock');
        Route::get('/me', 'UserController@me');
        Route::post('/pub', 'UserController@pub');

        Route::get('/tree', 'OrgController@index');

        Route::get('/expos/create', 'ExpoController@create');
        Route::get('/expos', 'ExpoController@index');
    });

// });

Route::get('/test', function () {

    $a = App\User::find(1);
    print_r($a->conf['roles']);
    // $b = show($a->conf);
    // print_r($b);

});

Route::get('/in', function () {
    // $user = App\User::find(5);
    $user = App\User::find(6);
    // $user = App\User::find(1);
    // $user = App\User::find(8);
    Auth::login($user);
    print_r($user->info);
});

