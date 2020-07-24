<?php

use App\Jobs\WecahtGetTicket;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
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

// 系统
Route::get('/note', 'SysController@note');
Route::get('/msg', 'SysController@msg');
Route::get('/contact', 'SysController@contact');

Route::get('/trailer', 'ExpoController@trailer');

// wechat user
Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    
    // 展会预告
    
    Route::get('/sms', 'AuthController@sms');
    Route::post('/code', 'AuthController@code')->middleware('throttle:1,2');
    Route::post('/check', 'AuthController@check')->middleware('throttle:5,5');

    // auth users
    Route::group(['middleware' => ['mix', 'state']], function () {
        // ----- OA -----
        // 统计
        Route::get('/report', 'SysController@report');
        // Excel: 导入
        Route::get('/import/order', 'SysController@import');
        Route::post('/import/save_order', 'SysController@saveOrder');

        // Excel: 导出
        Route::get('/download/{key}', 'SysController@download');
        

        // 应用中心
        Route::get('/apps', 'SysController@apps');

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
        Route::post('/pub', 'UserController@pub'); # 公开

        // 机构
        Route::get('/orgs', 'OrgController@index');
        Route::get('/org/create/{id}', 'OrgController@create');
        Route::post('/org/store', 'OrgController@store');

        // 会展
        Route::get('/expos', 'ExpoController@index');
        Route::get('/expo/{id}', 'ExpoController@show');
        Route::post('/expo/allow/{id}', 'ExpoController@allow'); # 开关售票
        Route::get('/expo/sort/{id}', 'ExpoController@sort'); # 登记入场顺序
        Route::post('/expo/sort/store/{id}', 'ExpoController@sortStore'); # 登记入场顺序
        Route::get('/expos/create', 'ExpoController@create');
        Route::post('/expos/store', 'ExpoController@store');
        Route::get('/expos/notice', 'ExpoController@notice');

        // 票
        Route::get('/pay/{id}', 'TicketController@order');
        Route::get('/tickets', 'TicketController@index');
        Route::get('/ticket/{id}', 'TicketController@show');
        Route::post('/ticket/trans/{id}', 'TicketController@trans');

        //发现
        Route::get('/discoveries','DiscoveryController@index');
    });
});

Route::get('/test', function () {
    // $a = App\Order::find(17);
    // var_dump(empty($a->ticket));

    // $a = App\User::where('ids->mobile->number', '18616971891')->first();
    $b = App\User::where('ids->mobile->number', '18616712758')->first();

    var_dump($b);

    // $c = $a->tickets->count();
    // // $d = $b->tickets->count();

    // echo $c.'/';

    // $e = App\Ticket::where('sorted', 25296)->first();

    // print_r($e->logs);


});

// Route::get('/check', function () {

//     // $a = App\User::find(8)->orders;

//     $a = App\User::has('tickets')->get();


//     // echo $a.'-'.$b.'-'.$c.'-'.$d.'-';

//     foreach ($a as $key) {
        
//         echo '用户id: '.$key->id.'; 张数: '.$key->tickets->count().'<br>------<br>';

//         foreach ($key->tickets as $t) {
//             echo $t->id.'; 时间: '.$t->created_at.'<br>';
//         }
//         echo '---------------<br>';

//         $b = $key->orders;

//         $filtered = $b->reject(function ($v) {
//             return empty($v->status);
//         });

//         foreach ($filtered as $k) {
//             echo '交易号: '.$k->out_trade_no.'单号: '.$k->id.'; 金额: '.$k->total_fee/100 . '; ' . $k->status.' : '. $k->created_at .'<br>';
//         }

        

//         echo '=================<br>';
//     }

//     // $a = App\Ticket::orderBy('order_id')->distinct('order_id')->get();

//     // echo $a->count().'<br>-----<br>';

//     // foreach ($a as $key) {
//     //     # code...
//     //     echo '+'.$key->user->id.'-'.$key->order_id.'<br>';
//     // }
//     // echo now();
//     // $a = time();

//     // $b = date('Y-m-d H:i:s', $a);

//     // echo $b;

// });


// Route::get('/find', function () {
//     $arr = [11,133,159];
//     $users = App\User::whereIn('id', $arr)->get();

//     foreach ($users as $key) {
        
//         echo '用户id: '.$key->id.', 手机号:'.show($key->ids, 'mobile.number').'; 张数: '.$key->tickets->count().'<br>------<br>';

//         foreach ($key->tickets as $t) {
//             echo '票id号: '.$t->id.', 入场次序: '.$t->sorted .'; 对应交易号: '.$t->order->out_trade_no.'<br>';
//         }
//         echo '---------------<br>';

//         $b = $key->orders;

//         $filtered = $b->reject(function ($v) {
//             return empty($v->status);
//         });

//         foreach ($filtered as $k) {
//             echo '交易号: '.$k->out_trade_no.'单号: '.$k->id.'; 金额: '.$k->total_fee/100 . '; ' . $k->status.' : '. $k->created_at .'<br>';
//         }

        

//         echo '=================<br>';
//     }
// });


// ------------ dev -------------

// Route::get('/fake', 'WechatController@fake');



Route::get('/in', function () {
    // $user = App\User::find(5);
    $user = App\User::find(6);
    // $user = App\User::find(2);
    // $user = App\User::find(1);
    // $user = App\User::find(8);
    Auth::login($user);
    print_r($user->info);
});
