<?php

namespace App\Wechat;

use App\Org;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventHandler implements EventHandlerInterface
{
    protected $msg, $ad_array;

    protected $limit = ['staff', 'customer', 'supplier', 'partner'];

    function __construct()
    {
        $app = app('wechat.official_account');

        $this->msg = $app->server->getMessage();
    }

    /**
     * 处理器
     *
     * array (
     *   'ToUserName' => 'gh_70d61fb80c1a',
     *   'FromUserName' => 'oNqBdwRZTz-3T09LrmLGRyQYMsBo',
     *   'CreateTime' => '1591412104',
     *   'MsgType' => 'event',
     *   'Event' => 'SCAN',
     *   'EventKey' => 'ad_customer_5',
     *   'Ticket' => 'gQFA8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyeDRxX3huU3dkdDExTXFuQXh1Y1UAAgSa3NpeAwSAOgkA',
     *  )
     *
     */
    public function handle($payload = NULL)
    {
        if($this->msg['Event'] == 'SCAN') {

            // 关注后扫荐码
            if(Str::startsWith($this->msg['EventKey'], 'ad_')){
                $a = explode('_', $this->msg['EventKey']);
                if(count($a) == 3) {
                    $this->ad_array = ['created_by' => intval($a[2]), 'key' => $a[1]];

                    return $this->ad();
                }

            }
        }elseif($this->msg['Event'] == 'subscribe'){
            // 扫推荐码关注
            if(Str::startsWith($this->msg['EventKey'], 'qrscene_ad_')){
                $a = explode('_', $this->msg['EventKey']);
                if(count($a) == 4) {
                    $this->ad_array = ['created_by' => intval($a[3]), 'key' => $a[2]];

                    return $this->ad();
                }
            }

            // 关注后推送
        }

    }

    /**
     * 推荐
     *
     */
    private function ad()
    {
        return $this->check() ? "请于10分钟内完成手机认证,否则授权可能会过期" : "无效操作";

    }

    private function check()
    {
        if($this->ad_array['created_by'] < 1) return false;

        $org  = Org::where('key', $this->ad_array['key'])->first();
        $user = User::find($this->ad_array['created_by']);

        if($org && $user && $user->can($this->ad_array['key'].'Qrcode', User::class)) {
            $save = ['created_by' => $this->ad_array['created_by'], 'conf' => [['org_id' => $org->id]]];

            Redis::setex($this->msg['FromUserName'], 600, json_encode($save));
            return true;
        }

        return false;
    }

}
