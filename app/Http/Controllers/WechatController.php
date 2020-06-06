<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Arr;
use App\Wechat\EventHandler;
use Illuminate\Support\Facades\Auth;
use EasyWeChat\Kernel\Messages\Message;

class WechatController extends Controller
{
    protected $app;

    function __construct()
    {
        $this->app = app('wechat.official_account');
    }
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {

        $this->app->server->push(EventHandler::class, Message::EVENT);

        $response = $this->app->server->serve();
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
            // $app = app('wechat.official_account');
            $reasult = $this->app->qrcode->temporary('ad_'.$type.'_'.Auth::id(), 60*60*24*7); # 1周
            $reasult = Arr::add($reasult, 'expire', ($reasult['expire_seconds'] + time() - 60));
            $save = Auth::user()->update(['ids->wechat->qrcode->'.$type => $reasult]);

            return $reasult['url'];
        }
    }

    /**
     * 初始化菜单
     *
     */
    public function init()
    {
        $buttons = [

            [
                "type" => "scancode_push",
                "name" => "扫一扫",
                "key"  => "wechat_menu"
            ],
            [
                "type" => "view",
                "name" => "应用",
                "url"  => "https://wechat.mooibay.com/apps"
            ],
            [
                "type" => "view",
                "name" => "我",
                "url"  => "https://wechat.mooibay.com/me"
            ],
        ];

        $this->app->menu->create($buttons);

        return view('note');
    }


}
