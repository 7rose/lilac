<?php

namespace App\GraphQL\Mutations;

use App\Comment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class NewComment
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $ex = Comment::where('video_id', $args['video_id'])->where('created_by', Auth::id())->first();
        if($ex) return $ex;

        $content = [
            'sub_title' => $args['sub_title'],
        ];

        if(isset($args['title'])) $content = Arr::add($content, 'title', $args['title']);


        $new = [
            'content' => $content,
            'created_by' => Auth::id(),
            'video_id' => $args['video_id'],
        ];

        $resault = Comment::create($new);

        return $resault;
    }
}
