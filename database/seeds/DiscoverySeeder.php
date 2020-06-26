<?php
use App\Discovery;
use Illuminate\Database\Seeder;

class DiscoverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Discovery::create([
            'title'  => '闺蜜房就给你们安排上了，就看你们闺蜜的啦😏😏😏',
            'content' => '闺蜜房就给你们安排上了，就看你们闺蜜的啦😏😏😏闺蜜房就给你们安排上了，就看你们闺蜜的啦😏😏😏闺蜜房就给你们安排上了，就看你们闺蜜的啦😏😏😏',
            'cover_image' => 'http://ci.xiaohongshu.com/23ab7b9b-902b-54ba-9a2b-0d0b55183e20?imageView2/2/w/540/format/jpg',
            'author' => ['id'=>8,'name' => '丁丽丽', 'nick' => 'yama'],
            'eye_images' => ['http://ci.xiaohongshu.com/23ab7b9b-902b-54ba-9a2b-0d0b55183e20?imageView2/2/w/540/format/jpg'],
        ]);
        Discovery::create([
            'title'  => '清晨空腹燃脂❗️一起瘦瘦瘦❗️亲测有效！',
            'content' => '清晨空腹燃脂❗️一起瘦瘦瘦❗️亲测有效！清晨空腹燃脂❗️一起瘦瘦瘦❗️亲测有效！清晨空腹燃脂❗️一起瘦瘦瘦❗️亲测有效！清晨空腹燃脂❗️一起瘦瘦瘦❗️亲测有效！',
            'cover_image' => 'http://ci.xiaohongshu.com/8f3c77f1-60f8-5b66-94f1-85cfd1624008?imageView2/2/w/540/format/jpg',
            'author' => ['id'=>8,'name' => '丁丽丽', 'nick' => 'yama'],
            'eye_images' => ['http://ci.xiaohongshu.com/23ab7b9b-902b-54ba-9a2b-0d0b55183e20?imageView2/2/w/540/format/jpg'],
        ]);
        Discovery::create([
            'title'  => '藏区游牧民族的转场，牦牛背上的小朋友',
            'content' => '藏区游牧民族的转场，牦牛背上的小朋友藏区游牧民族的转场，牦牛背上的小朋友藏区游牧民族的转场，牦牛背上的小朋友藏区游牧民族的转场，牦牛背上的小朋友藏区游牧民族的转场，牦牛背上的小朋友',
            'cover_image' => 'http://ci.xiaohongshu.com/526c308e-4a19-5b9c-a7ce-ac1ce5dc033b?imageView2/2/w/540/format/jpg',
            'author' => ['id'=>8,'name' => '丁丽丽', 'nick' => 'yama'],
            'eye_images' => ['http://ci.xiaohongshu.com/23ab7b9b-902b-54ba-9a2b-0d0b55183e20?imageView2/2/w/540/format/jpg'],
        ]);
        Discovery::create([
            'title'  => '广州端午好去处，广东也有超震撼佛手打卡地',
            'content' => '广州端午好去处，广东也有超震撼佛手打卡地广州端午好去处，广东也有超震撼佛手打卡地广州端午好去处，广东也有超震撼佛手打卡地广州端午好去处，广东也有超震撼佛手打卡地广州端午好去处，广东也有超震撼佛手打卡地',
            'cover_image' => 'http://ci.xiaohongshu.com/84f4affc-fd7d-58fc-91c4-2970412cfc11?imageView2/2/w/540/format/jpg',
            'author' => ['id'=>8,'name' => '丁丽丽', 'nick' => 'yama'],
            'eye_images' => ['http://ci.xiaohongshu.com/23ab7b9b-902b-54ba-9a2b-0d0b55183e20?imageView2/2/w/540/format/jpg'],
        ]);
        Discovery::create([
            'title'  => '满满正能量的一周开始啦！摩托车小伙🏍️',
            'content' => '满满正能量的一周开始啦！摩托车小伙🏍️满满正能量的一周开始啦！摩托车小伙🏍️满满正能量的一周开始啦！摩托车小伙🏍️',
            'cover_image' => 'http://ci.xiaohongshu.com/3cde1ae3-f780-58db-b7dd-8650cf203bba?imageView2/2/w/540/format/jpg',
            'author' => ['id'=>8,'name' => '丁丽丽', 'nick' => 'yama'],
            'eye_images' => ['http://ci.xiaohongshu.com/23ab7b9b-902b-54ba-9a2b-0d0b55183e20?imageView2/2/w/540/format/jpg'],
        ]);
        Discovery::create([
            'title'  => '购物VLOG🎠CHANEL买买买',
            'content' => '购物VLOG🎠CHANEL买买买，购物VLOG🎠CHANEL买买买，购物VLOG🎠CHANEL买买买，购物VLOG🎠CHANEL买买买',
            'cover_image' => 'http://ci.xiaohongshu.com/f71f500e-673c-5399-8d01-9734bb2d5e56?imageView2/2/w/540/format/jpg',
            'author' => ['id'=>8,'name' => '丁丽丽', 'nick' => 'yama'],
            'eye_images' => ['http://ci.xiaohongshu.com/23ab7b9b-902b-54ba-9a2b-0d0b55183e20?imageView2/2/w/540/format/jpg'],
        ]);
    }
}
