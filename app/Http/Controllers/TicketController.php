<?php

namespace App\Http\Controllers;

use App\Expo;
use App\Order;
use App\Ticket;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    protected $payment;

    function __construct()
    {
        $this->payment =  app('wechat.payment');
    }
    /**
     * 微信支付购票
     *
     *
     */
    public function order($id)
    {
       $expo =  Expo::findOrFail($id);

        $info = [
            'body' => show($expo->info, 'title', '').'电子门票',
            'out_trade_no' => Auth::id().'-'.$expo->id.'-'.time(),
            'total_fee' => show($expo->info, 'price') ? floor(floatval(show($expo->info, 'price'))*100) : 20000, # 分
            // 'spbill_create_ip' => '123.12.12.123', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
            // 'notify_url' => 'https://pay.weixin.qq.com/wxpay/pay.action', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
            'openid' =>  show(Auth::user()->ids, 'wechat.id'),
            ];

        $order = $this->payment->order->unify($info);

        if(Arr::has($order, 'return_code') && Arr::get($order, 'return_code') == 'SUCCESS' && Arr::has($order, 'result_code') && Arr::get($order, 'result_code') == 'SUCCESS' && Arr::has($order, 'prepay_id')){
            $prepayId = Arr::get($order, 'prepay_id');

            // 写入
            Order::create($info);
        }else{
            abort('510');
        }

        $jssdk = $this->payment->jssdk;
        $json = $jssdk->bridgeConfig($prepayId);

        return view('pay', compact('json','info'));
    }

    /**
     * 支付结果回调
     *
     */
    function payCallback()
    {
        $app = app('wechat');

        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Order::where('out_trade_no', $notify->out_trade_no)->first();

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->paid_at) {
                return true;
            }

            // 用户是否支付成功
            if ($successful) {

                // 生成电子票
                $this->getTicket($notify);

                $order->paid_at = now(); // 更新支付时间为当前时间
                $order->status = '支付成功';
            } else { // 用户支付失败
                $order->status = '支付失败';
            }

            $order->save();

            return true;
        });

        return $response;
    }

    /**
     * 电子票
     *
     */
    private function getTicket($notify)
    {
        $p = explode(',', $notify->out_trade_no);

        $order = Order::where('out_trade_no', $notify->out_trade_no)->firstOrFail();

        $new = [
            'user_id' => $p[0],
            'expo_id' => $p[1],
            'order_id' => $order->id,
        ];

        Ticket::create($new);
    }

    /**
     * 票
     *
     */
    public function tickets()
    {
        $tickets = Ticket::paginate(20);

    }

    /**
     * 订单
     *
     */
    public function orders()
    {
        $orders = Order::paginate(20);

        return view('ticket.orders', compact('orders'));
    }


}
