<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
        $app->server->push(function ($message) {
            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '海上牧云欢迎您!';
                    break;
            }
        });

        return $app->server->serve();
    }

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
        if(Auth::user()->can('customer-qrcode')) $urls = Arr::add($urls, 'customer', $this->get('customer'));
        if(Auth::user()->can('supplier-qrcode')) $urls = Arr::add($urls, 'supplier', $this->get('supplier'));
        if(Auth::user()->can('partner-qrcode')) $urls = Arr::add($urls, 'partner', $this->get('partner'));

        return view('wechat.ad', compact('urls'));
    }

    /**
     * 推荐客户
     *
     */
    public function customer()
    {
        $url = $this->get('customer');
    }

    /**
     * 发展供应商
     *
     */
    public function supplier()
    {
        $this->authorize('supplierQrcode', User::class);
        return $this->get('supplier');
    }

    /**
     * 推荐合作方
     *
     */
    public function partner()
    {
        $this->authorize('partnerQrcode', User::class);
        return $this->get('partner');
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
