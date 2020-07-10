<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class WecahtGetTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // protected $app;
    protected $template_id;

    protected $send_array;

    function __construct($send_array)
    {
        $this->template_id = 'ZoZKJTudbfjtuCnbpkeBb0y5OyAPJ8_AgY--2Rm7CkM';
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
            'url' => config('app.url').'/ticket/'.$this->send_array['ticket_id'],
            'data' => [
                'first' => "尊敬的{$this->send_array['name']}, 您已成功购票!",
                'keyword1' => $this->send_array['expo_title'],
                'keyword2' => $this->send_array['ticket_id'],
                'keyword3' => $this->send_array['expo_begin'],
                'keyword4' => $this->send_array['expo_addr'],
                'remark' => '您可以点击此消息查看票面信息和出示二维码检票，谢谢!',
            ],
        ];
        
        Log::info($ready);
        
        $app = app('wechat.official_account');
        $app->template_message->send($ready);
    }
}
