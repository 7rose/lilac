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
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题2',
                'sub_title' => '测试副标题和内容2',
                'url' => config('app.url').'/storage/test.mp4',
            ],
            'created_by' => 2
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题3',
                'sub_title' => '测试副标题和内容3',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题4',
                'sub_title' => '测试副标题和内容4',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题5',
                'sub_title' => '测试副标题和内容5',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题6',
                'sub_title' => '测试副标题和内容6',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题7',
                'sub_title' => '测试副标题和内容7',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题8',
                'sub_title' => '测试副标题和内容8',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题9',
                'sub_title' => '测试副标题和内容9',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题10',
                'sub_title' => '测试副标题和内容10',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题11',
                'sub_title' => '测试副标题和内容11',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题12',
                'sub_title' => '测试副标题和内容12',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

        Video::create([
            'content' => [
                'title' => '测试标题13',
                'sub_title' => '测试副标题和内容13',
                'url' => config('app.url').'/storage/test.mp4',
                'cover' => config('app.url').'/storage/test.jpg',
            ],
            'show' => true,
            'created_by' => 1
        ]);

    }
}