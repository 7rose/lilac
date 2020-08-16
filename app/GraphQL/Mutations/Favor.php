<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;

class Favor
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $user = Auth::guard('sanctum')->user();

        $old = show($user->info, 'favorites.'.$args['type'], []);

        if(in_array($args['id'], $old)) {
            unset($old[array_search($args['id'], $old)]);
            $re = ['success' => true, 'do' => 'remove', 'message' => '已从关注列表中移除'];
        } else{
            array_push($old, $args['id']);
            $re = ['success' => true, 'do' => 'add', 'message' => '已添加至关注列表'];
        }

        $old_info = $user->info;
        $old_info['favorites'][$args['type']] = $old;

        $user->update(['info' => $old_info]);

        return $re;

    }
}
