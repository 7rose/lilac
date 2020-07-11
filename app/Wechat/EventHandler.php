<?php

namespace App\Wechat;

use App\Helpers\Expos;
use App\Org;
use App\User;
use App\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use EasyWeChat\Kernel\Messages\News;
use Illuminate\Support\Facades\Redis;
use EasyWeChat\Kernel\Messages\NewsItem;
use Illuminate\Auth\Access\HandlesAuthorization;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class EventHandler implements EventHandlerInterface
{
    use HandlesAuthorization;

    protected $msg, $ad_array;
    protected $t_array;

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

                    // return $this->ad(); # 推荐
                    $this->ad();
                }

            }elseif(Str::startsWith($this->msg['EventKey'], 't_')){
                $a = explode('_', $this->msg['EventKey']);
                $this->t_array = ['user_id' => intval($a[1]), 'ticket_id' => intval($a[2])];
                return $this->checkTicket(); # 检票
            }
        }elseif($this->msg['Event'] == 'subscribe'){

            // 扫推荐码关注
            if(Str::startsWith($this->msg['EventKey'], 'qrscene_ad_')){
                $a = explode('_', $this->msg['EventKey']);
                if(count($a) == 4) {
                    $this->ad_array = ['created_by' => intval($a[3]), 'key' => $a[2]];

                    // return $this->ad();
                    $this->ad();
                }

            }elseif(Str::startsWith($this->msg['EventKey'], 'qrscene_t_')){
                $a = explode('_', $this->msg['EventKey']);
                $this->t_array = ['user_id' => intval($a[2]), 'ticket_id' => intval($a[3])];
                return $this->checkTicket(); # 检票
            }

            $items = [
                new NewsItem([
                    'image'       => asset('images/mooibay.jpg'),
                    'title'       => "MOOIBAY 欢迎您!",
                    'description' => 'Find Your Dream',
                    'url'         => config('app.url'),
                    // ...
                ]),
            ];
            $news = new News($items);
            return $news;

            // 关注后推送
        }

    }

    /**
     * 推荐
     *
     */
    private function ad()
    {
        // return $this->adCheck() ? "请于10分钟内完成手机认证,否则授权可能会过期" : "无效操作";
        return $this->adCheck();

    }

    /**
     * 推荐检查
     *
     */
    private function adCheck()
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

    /**
     * 检票
     *
     */
    private function checkTicket()
    {
        $ticket = Ticket::find($this->t_array['ticket_id']);
        $operator = User::where('ids->wechat->id', $this->msg['FromUserName'])->first();

        if(!$operator->can('checkTicket', $ticket->expo)) return "请客户在开展前将票出示给工作人员";

        if(!$ticket || !$operator) return "失败: 无效操作";

        // 有权限
        // 新票
        if(!$ticket->used) {
            // 不在检票时间
            $e = new Expos;
            if($e->early($ticket->expo)) return $e->early($ticket->expo)."开始检票";
            if($e->late($ticket->expo)) return $e->late($ticket->expo)."已过可检票时间";

            $add = $ticket->logs;
            $add[] = ['time' => time(), 'do' => '检票', 'by' => $operator->id];

            $ticket->used = true;
            $ticket->logs = $add;
            $ticket->save();

            $msg = empty($ticket->sorted) ? '注: 此票没有登记入场次序!' : '入场次序:'.$ticket->sorted;

            return "检票成功! ".$msg;

        // 临时离场
        }elseif($ticket->used && $ticket->afk) {

            $add = $ticket->logs;
            $add[] = ['time' => time(), 'do' => '临时离场后进场', 'by' => $operator->id];

            $ticket->afk = false;
            $ticket->logs = $add;
            $ticket->save();

            return "成功: 临时离场客户进场!";
        }

        return "失败: 票已失效!";
    }

}
