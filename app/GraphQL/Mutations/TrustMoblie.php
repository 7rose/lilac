<?php

namespace App\GraphQL\Mutations;

use App\User;
use EasyWeChat\Kernel\Support\Arr;
use Illuminate\Support\Facades\Http;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TrustMoblie
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
        // $jv_token = $args['jv_token'];

        // // 极光认证配置
        // $jv_id = config('lilac.jv.id');
        // $jv_secret = config('lilac.jv.secret');
        // $jv_key = config('lilac.jv.key');
        // $jv_url = config('lilac.jv.url');

        // $response = Http::withBasicAuth($jv_id, $jv_secret)
        // ->withHeaders([
        //     'X-Content-Type' => 'application/json',
        // ])
        // ->post($jv_url, [
        //     'loginToken' => $jv_token,
        //     // 'exID' => str_random(10), # 可选
        // ]);

        // $from_jv = json_decode($response->body(), true);

        // $encrypted = Arr::get($from_jv, 'phone');
        // $result = '';

        // $key = file_get_contents($jv_key);

        // openssl_private_decrypt(base64_decode($encrypted), $result, openssl_pkey_get_private($key));


        // $user = User::where('ids->mobile->number',$result)->first();

        // if(!$user) {
        //     $new = [
        //         'ids' => ['mobile' => ['number' => $result, 'active'=>true, 'veryfied_at' => now()]],
        //     ];
        //     $user = User::create($new);
        // }

        // $token =  $user->createToken($result)->plainTextToken;

        return [
            'token' => 'ok',
        ];

    }
}
