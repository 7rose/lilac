<?php

use App\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            'content' => [
                'title' => '测试标题1',
                'sub_title' => '测试副标题和内容1',
                'url' => config('app.url').'/public/storage/test.mp4',
            ],
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题2',
                'sub_title' => '测试副标题和内容2',
                'url' => config('app.url').'/public/storage/test.mp4',
            ],
            'created_by' => 2
        ]);
    }
}