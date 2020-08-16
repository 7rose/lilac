<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'video_id' => 1,
            'content' => [
                'title' => '[评论]测试标题1',
                'sub_title' => '[评论]测试副标题和内容1',
            ],
            'created_by' => 7
        ]);

        Comment::create([
            'video_id' => 2,
            'content' => [
                'title' => '[评论]测试标题2',
                'sub_title' => '[评论]测试副标题和内容2',
            ],
            'created_by' => 7
        ]);

        Comment::create([
            'video_id' => 2,
            'content' => [
                'title' => '[评论]测试标题3',
                'sub_title' => '[评论]测试副标题和内容3',
            ],
            'created_by' => 8
        ]);
    }
}
