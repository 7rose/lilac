<?php

namespace App\GraphQL\Mutations;

use App\User;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Redis;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class GetToken
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
        $device_id = $context->request()->header('device-id');

        $auth_info = Redis::get($device_id);

        if(!$auth_info || $args['mobile'] != json_decode($auth_info, true)['mobile']) throw new Error("400@无效或者过期信息");
        if(!$auth_info || $args['code'] != json_decode($auth_info, true)['code']) throw new Error("400@验证码错误");

        $user = User::where('ids->mobile->number',$args['mobile'])->first();

        if(!$user) {
            $new = [
                'ids' => ['mobile' => ['number' => $args['mobile'], 'active'=>true, 'veryfied_at' => now()]],
            ];
            $user = User::create($new);
        }

        if(Redis::exists($device_id)) Redis::del($device_id);
        
        $token =  $user->createToken($device_id)->plainTextToken;
        
        return [
            'token' => $token,
        ];
    }
}
