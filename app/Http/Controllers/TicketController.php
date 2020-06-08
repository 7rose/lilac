<?php

namespace App\Http\Controllers;

use App\Expo;
use EasyWeChat\Factory;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function order($id)
    {
       $expo =  Expo::findOrFail($id);

        $payment = app('wechat.payment');

        $info = [
            'body' => show($expo->info, 'title', '').'电子门票',
            'out_trade_no' => Auth::id().time(),
            'total_fee' => show($expo->info, 'price') ? intval(floatval(show($expo->info, 'price'))*100) : 20000, # 分
            // 'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
            // 'notify_url' => 'https://pay.weixin.qq.com/wxpay/pay.action', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
            'openid' =>  show(Auth::user()->ids, 'wechat.id'),
            ];

        $order = $payment->order->unify($info);

        if(Arr::has($order, 'return_code') && Arr::get($order, 'return_code') == 'SUCCESS' && Arr::has($order, 'result_code') && Arr::get($order, 'result_code') == 'SUCCESS' && Arr::has($order, 'prepay_id')){
            $prepayId = Arr::get($order, 'prepay_id');
        }else{
            abort('510');
        }

        $jssdk = $payment->jssdk;
        $json = $jssdk->bridgeConfig($prepayId);

        return view('pay', compact('json','info'));
    }


}
