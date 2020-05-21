<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use AlibabaCloud\Client\AlibabaCloud;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class SendSmsCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $code, $mobile;
    protected $access_key_id, $access_secret, $region_id;
    protected $sign_name, $template_code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_array)
    {
        $this->region_id=config('lilac.aliyun_sms.region_id');
        $this->access_key_id=config('lilac.aliyun_sms.access_key_id');
        $this->access_secret=config('lilac.aliyun_sms.access_secret');

        $this->sign_name=config('lilac.aliyun_sms.sign_name');
        $this->template_code=config('lilac.aliyun_sms.template_code');

        $this->mobile=$send_array['mobile'];
        $this->code=$send_array['code'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        AlibabaCloud::accessKeyClient($this->access_key_id, $this->access_secret)
                        ->regionId($this->region_id)
                        ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                  ->product('Dysmsapi')
                                  // ->scheme('https') // https | http
                                  ->version('2017-05-25')
                                  ->action('SendSms')
                                  ->method('POST')
                                  ->host('dysmsapi.aliyuncs.com')
                                  ->options([
                                                'query' => [
                                                  'RegionId' => $this->region_id,
                                                  'PhoneNumbers' => $this->mobile,
                                                  'SignName' => $this->sign_name,
                                                  'TemplateCode' => $this->template_code,
                                                  'TemplateParam' => "{\"code\":\"$this->code\"}"
                                                ],
                                            ])
                                  ->request();
            print_r($result->toArray());
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
    }
}
