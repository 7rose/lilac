<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;

class Favor
{
    private $id;

    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = Auth::guard('sanctum')->user();

        $old = show($user->info, 'favorites.'.$args['type'], []);

        $this->id = $args['id'];

        $collection = collect($old);

        $filtered = $collection->reject(function ($value, $key) {
            return $value['id'] == $this->id;
        });

        $new = $filtered->all();

        $re = ['success' => true, 'do' => 'remove', 'message' => '已从关注列表中移除'];

        if(count($old) == count($new)) {
            $new[] = ['id' => $args['id'], 'time' => time()];
            $re = ['success' => true, 'do' => 'add', 'message' => '已添加至关注列表'];
        }

        $old_info = $user->info;
        $old_info['favorites'][$args['type']] = $new;

        $user->update(['info' => $old_info]);

        return $re;

    }
}
