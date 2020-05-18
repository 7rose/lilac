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

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::any('/wechat', 'WeChatController@serve');

Route::get('/sms', 'AuthController@sms');
Route::post('/code', 'AuthController@code')->middleware('throttle:100,2');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    $b = str_random(32);
    echo $b;
    // return view('auth.check');
    // $r = App\User::find(1)->children;
    // print_r($r);
    // foreach ($r as $key => $value) {
    //     echo $value->id;
    // }
    // echo $r;
});
