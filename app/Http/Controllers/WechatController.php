<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\EventHandler;
use App\Helpers\MessageHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use EasyWeChat\Kernel\Messages\Message;

class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        $app = app('wechat.official_account');

        $app->server->push(EventHandler::class, Message::EVENT);

        $response = $app->server->serve();
        return $response;

    }

    /**
     * 回调
     *
     */
    public function callBack()
    {
        //
    }

    /**
     * 推荐客户
     *
     */
    public function ad()
    {
        $urls = [];
        if(Auth::user()->can('customerQrcode', User::class)) $urls = Arr::add($urls, 'customer', $this->get('customer'));
        if(Auth::user()->can('supplierQrcode', User::class)) $urls = Arr::add($urls, 'supplier', $this->get('supplier'));
        if(Auth::user()->can('partnerQrcode', User::class)) $urls = Arr::add($urls, 'partner', $this->get('partner'));

        return view('wechat.ad', compact('urls'));
    }

    /**
     * 保存链接
     *
     */
    private function get($type)
    {
        if(show(Auth::user()->ids, 'wechat.qrcode.'.$type) && show(Auth::user()->ids, 'wechat.qrcode.'.$type.'.expire') && show(Auth::user()->ids, 'wechat.qrcode.'.$type.'.expire') > time()) {
            return show(Auth::user()->ids, 'wechat.qrcode.'.$type.'.url');
        }else{
            $app = app('wechat.official_account');
            $reasult = $app->qrcode->temporary('ad_'.$type.'_'.Auth::id(), 60*60*24*7); # 1周
            $reasult = Arr::add($reasult, 'expire', ($reasult['expire_seconds'] + time() - 60));
            $save = Auth::user()->update(['ids->wechat->qrcode->'.$type => $reasult]);

            return $reasult['url'];
        }
    }


}
