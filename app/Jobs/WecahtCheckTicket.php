<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WecahtCheckTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // protected $app;
    protected $template_id;

    protected $send_array;

    function __construct($send_array)
    {
        $this->template_id = '9hrAgiAvjxewGhYGb0YhkDHFjNzeOIUowOPu-zjvvj0';
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
                'first' => "尊敬的{$this->send_array['name']}, 您电子票已被使用!",
                'keyword1' => $this->send_array['expo_title'],
                'keyword2' => 1,
                'keyword3' => $this->send_array['time'],
                // 'keyword4' => $this->send_array['expo_addr'],
                'remark' => '感谢您的莅临! 如有任何疑问或者需要帮助请与现场工作人员联系，谢谢!',
            ],
        ];
        
        // Log::info($ready);
        
        $app = app('wechat.official_account');
        $app->template_message->send($ready);
    }
}
