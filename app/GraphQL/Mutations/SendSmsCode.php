<?php

namespace App\GraphQL\Mutations;

use App\User;
use GraphQL\Error\Error;
use App\Jobs\SendSmsCodeJob;
use Illuminate\Support\Facades\Redis;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class SendSmsCode
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $expire = 300; # 5分钟有效
        $rate = 120; # 2分钟
        
        $device_id = $context->request()->header('device-id');
        $mobile = $args['mobile'];
        
        if(Redis::exists($device_id.'_rate')) throw new Error("429@请于".Redis::ttl($device_id.'_rate')."秒后重试");

        $code = rand(100000, 999999);

        $send = [
            'mobile' => $mobile,
            'code' => $code,
        ];

        Redis::setex($device_id.'_rate', $rate, $rate);
        Redis::setex($device_id, $expire, \json_encode($send));

        SendSmsCodeJob::dispatch($send);

        $ex = User::where('ids->mobile->number',$mobile)->first();

        $fake = ['registered' => $ex ? true: false, 'success' => true];

        return $fake;
    }
}
