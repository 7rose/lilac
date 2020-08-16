<?php

namespace App\GraphQL\Mutations;

use App\Star as StarModel;
use Illuminate\Support\Facades\Auth;

class Star
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $ex = StarModel::where('video_id', $args['video_id'])->where('created_by', Auth::guard('sanctum')->id())->first();

        if($ex){
            $ex->delete();
            return ['success' => true, 'do' => 'unstar', 'message' => '已收回赞'];
        } else {
            $re = StarModel::create([
                'video_id' => $args['video_id'],
                'created_by' => Auth::guard('sanctum')->id(),
            ]);
            return ['success' => true, 'do' => 'star', 'message' => '已赞'];
        }
    }
}
