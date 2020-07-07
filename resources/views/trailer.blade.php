@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="container col-sm-8 col-xs-12 p-centered">
    <div class="column col-6 col-xs-12">
        <div class="card">
            <div class="card-image"><img class="img-responsive" src="{{ asset('images/main.jpg') }}" alt=".."></div>

            <div class="card-header">
            </div>
            <div class="card-body">
                <h5>SSF  2020 夏季展</h5>
时间：2020.7.25 - 7.26<br>
地点：上海市静安区万航渡路838号柒彩里5层<br>
联合主办：First Meet Gallery x Mooi Design<br>
更多信息即将揭晓<br>
<blockquote>
    <p><small>“乘风破浪”的娃友们，重拾起自己沉寂已久的玩心，来遇见让你再次心动不已的玩具吧。在SSF面基群内老友，吐露这段时间的心情；结识新友，创造新的美好回忆；还可以亲口把自己的支持告诉你喜欢的设计师，更重要的是，pick自己喜爱的玩具带回家！

        First Meet Gallery携手Mooi Design联合主办，用心为你打造这个夏季最in最high最开心的潮流玩具展，一个属于大人的玩具乐园。多元的潮玩IP，多样的个性玩具，丰富的现场互动，等你参加，准备好加入我们了吗?!
         
        2020年7月25日-7月26日，我们在上海市静安区万航渡路838号柒彩里5层等你来玩~更多精彩内容、一手资讯请关注我们的官方公众账号，敬请期待！</small></p>
    <cite>- 海上牧云</cite>
    </blockquote>
            </div>
        </div>
        <p></p>
        
        <div class="card">
            <div class="card-header">
                <div class="card-title h5">合作展商</div>
                <div class="card-subtitle text-gray">动态更新,欢迎随时关注!</div>
              </div>
        <div class="card-image">
            <img src="{{ asset('expo/brand1.jpg') }}" class="img-responsive">
        </div>
            <div class="card-body">
                <span class="text-primary">【参展品牌】</span>
                <p>铄猫造物</p>
                <span class="text-primary">【设计师/品牌简介】</span>
                <p>主理人：呼啸，18年注册创立铄猫造物工作室推出兜兜妞妞潮玩品牌，以让这个世界变得有趣一点点为初衷，设计着独特而有趣的潮玩。
通过风格化的设计来表现一个有趣可爱的小世界，希望大家看到后能开心和喜欢。</p>
                <span class="text-primary">【代表作品】</span>
                <p>《DOUDOU兜兜&NIUNIU妞妞》系列</p>
                <span class="text-primary">【Follow】</span>
                <p>品牌微博：@铄猫造物HULUTOYS<br>
                    品牌公众号：铄猫造物HULUTOYS</p>
            <div class="card-image">
                <img src="{{ asset('expo/1.jpg') }}" class="img-responsive">
            </div>
            <div class="card-image">
                <img src="{{ asset('expo/2.jpg') }}" class="img-responsive">
            </div>
            <div class="card-image">
                <img src="{{ asset('expo/3.jpg') }}" class="img-responsive">
            </div>


                ...
            </div>
            <div class="card-footer">
                <blockquote>
                    <p><small>动态更新,每日新鲜,欢迎回来看我..</small></p>
                    <cite>- 海上牧云</cite>
                    </blockquote>
            </div>
        </div>

    </div>
</div>
@endsection
