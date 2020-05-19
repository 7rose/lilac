<?php

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

Route::get('/sms', 'AuthController@sms');
Route::post('/code', 'AuthController@code')->middleware('throttle:100,2');

Route::get('/', function () {
    return view('welcome');
});


// wechat user
Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/me', 'UserController@me');

    // auth users
    Route::group(['middleware' => ['mix']], function () {
        Route::get('/expos', 'UserController@index');
    });
});

// Route::group(['middleware' => ['mix']], function () {
//     Route::get('/expos', 'UserController@me');
// });

// Route::get('/me', 'UserController@index');

Route::get('/apps', function () {
    $app = app('wechat.official_account');
        // $oauth = $app->oauth->scopes(['snsapi_userinfo']);

        // 获取 OAuth 授权结果用户信息
        // $user = $oauth->user();
        $user = $app->oauth->user();

        print_r($user);

    // $b = str_random(32);
    // echo $b;
    // echo "fucking";
    // return view('auth.check');
    // $r = App\User::find(1)->children;
    // print_r($r);
    // foreach ($r as $key => $value) {
    //     echo $value->id;
    // }
    // echo $r;
});
