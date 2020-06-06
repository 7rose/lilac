<?php

namespace App\Wechat;

use App\Org;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use EasyWeChat\Kernel\Messages\Message;
use Illuminate\Support\Facades\Session;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventHandler implements EventHandlerInterface
{
    protected $msg;

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
        // if($this->msg['Event'] == 'SCAN') {
            if(Str::startsWith($this->msg['EventKey'], 'ad_')) return $this->ad();
        // }

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
        $p = explode('_', $this->msg['EventKey']);
        Log::info($p);

        if(count($p) != 3 || intval($p[2]) < 1) return false;
        Log::info('1');

        $org  = Org::where('key', $p[1])->first();
        $user = User::find($p[2]);

        if(Arr::has($this->limit, $p[1]) && $org && $user) {
            Log::info('2');

            // if($user->can($p[1], User::class)) {
                Log::info('3');
                $save = ['created_by' => $p[2], ['conf' => [['org_id' => $org->id]]]];
                Redis::setex($this->msg['FromUserName'], 600, $save);
            // }
        }
        Log::info('4');
        return false;
    }

}
