<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WechatTicketPreregister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // protected $app;
    protected $template_id;

    protected $send_array;

    function __construct($send_array)
    {
        $this->template_id = 'xH76wHpXL9ZHO7O_hOPJXh026JL7OsydR-nk4yBs2Wg';
        $this->send_array = $send_array;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ready = [
            'touser' => $this->send_array['open_id'],
            'template_id' => $this->template_id,
            'url' => config('app.url').'/expos/notice',
            'data' => [
                'first' => "尊敬的牧云贵宾, 您已成功预登记本次会展!",
                'keyword1' => $this->send_array['name'],
                'keyword2' => $this->send_array['sorted'],
                'keyword3' => $this->send_array['expo_begin'],
                'keyword4' => $this->send_array['expo_addr'],
                'remark' => '为了节省您的宝贵时间, 请务必在票面或者点击本消息查看《参展规则》谢谢!',
            ],
        ];
        
        // Log::info($ready);
        
        $app = app('wechat.official_account');
        $app->template_message->send($ready);
    }
}
