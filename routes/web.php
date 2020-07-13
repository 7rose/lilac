<?php

use App\Jobs\WecahtGetTicket;

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

// 系统
Route::get('/note', 'SysController@note');
Route::get('/msg', 'SysController@msg');
Route::get('/contact', 'SysController@contact');


// wechat user
Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    
    // 展会预告
    Route::get('/trailer', 'ExpoController@trailer');
    
    Route::get('/sms', 'AuthController@sms');
    Route::post('/code', 'AuthController@code')->middleware('throttle:1,2');
    Route::post('/check', 'AuthController@check')->middleware('throttle:5,5');

    // auth users
    Route::group(['middleware' => ['mix', 'state']], function () {

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

        // 票
        Route::get('/pay/{id}', 'TicketController@order');
        Route::get('/tickets', 'TicketController@index');
        Route::get('/ticket/{id}', 'TicketController@show');
        Route::post('/ticket/trans/{id}', 'TicketController@trans');

        //发现
        Route::get('/discoveries','DiscoveryController@index');
    });
});

// ------------ dev -------------

Route::get('/fake', 'WechatController@fake');

Route::get('/idkLDOSjMopKymdi', function () {
    // abort('403');
    $users = App\User::has('tickets')->get()->count();
    // $u1 =  App\User::where(function($query))->get()->count();
    $u1 = App\User::has('tickets',1)->get()->count();
    $u2 = App\User::has('tickets',2)->get()->count();
    $u3 = App\User::has('tickets',3)->get()->count();
    $u4 = App\User::has('tickets',4)->get()->count();

    
    $t = App\Ticket::all()->count();
    $t1 = App\Ticket::whereDate('created_at', '2020-07-11')->get()->count();
    $t2 = App\Ticket::whereDate('created_at', '2020-07-12')->get()->count();
    
    // $t3 = App\Ticket::whereDate('created_at', '2020-07-11')->distinct('user_id')->count();
    // $t4 = App\Ticket::whereDate('created_at', '2020-07-12')->distinct('user_id')->count();

    $t5 = App\Ticket::where('expo_id',1)->get()->count();
    $t6 = App\Ticket::where('expo_id',2)->get()->count();
    
    echo '购票人数量: '.$users.'<br>购1张的: '.$u1.'<br>购2张的: '.$u2.'<br>购3张的: '.$u3.'<br>购4张的: '.$u4;
    // echo '<br>7/11买票人数: '.$t3. '<br>7/12买票人数:'.$t4;
    echo '<br>-----<br>总销售: '.$t.', 其中 :<br>7/11: '.$t1.'<br>7/12: '.$t2;
    echo '<br> 7/25票已销售: '. $t5. '<br> 7/26票已销售: '. $t6;

    $u4 = App\User::all()->count();
    $u5 = App\User::whereDate('created_at', '2020-07-11')->get()->count();
    $u6 = App\User::whereDate('created_at', '2020-07-12')->get()->count();

    echo '<br>-----<br>注册用户: '.$u4.', 其中新增 :<br>7/11: '.$u5.'<br>7/12: '.$u6;

});

Route::get('/in', function () {
    // $user = App\User::find(5);
    $user = App\User::find(6);
    // $user = App\User::find(2);
    // $user = App\User::find(1);
    // $user = App\User::find(8);
    Auth::login($user);
    print_r($user->info);
});
