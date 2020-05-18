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

// wechat va
Route::any('/wechat', 'WechatController@serve');

Route::get('/sms', 'AuthController@sms');
Route::post('/code', 'AuthController@code')->middleware('throttle:100,2');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/me', function () {
        $user = session('wechat.oauth_user.default'); // 拿到授权用户资料

        dd($user);
    });
});


Route::get('/test', function () {
    // $b = str_random(32);
    // echo $b;
    echo "fucking";
    // return view('auth.check');
    // $r = App\User::find(1)->children;
    // print_r($r);
    // foreach ($r as $key => $value) {
    //     echo $value->id;
    // }
    // echo $r;
});
