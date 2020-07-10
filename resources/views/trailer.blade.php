<?php
    $e = new App\Helpers\Expos;
?>
@extends('nav')

@section('main')

<div class="nav-pad"></div>
<div class="container col-sm-8 col-xs-12 p-centered">
    <div class="column col-6 col-xs-12">
        <div class="card ">
            <div class="card-image"><img class="img-responsive" src="{{ asset('images/main.jpg') }}" alt=".."></div>
            
            <div class="article">
                <div class="card-header">
                    <h5>SSF  2020 夏季展</h5>
                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> <strong>日期</strong><br>2020/7/25 至 7/26 <br>
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <strong>地点</strong><br> 上海市静安区万航渡路838号柒彩里5层</p>
                </div>

                <div class="card-footer">
                    @if(Auth::check() && $e->buy(App\Expo::find(1)) && $e->buy(App\Expo::find(2)))
                    <div class="text-center"><h5>统一票价: ¥130</h5></div>
                    <p></p>
                    <div class="btn-group btn-group-block btn-big">
                        <button class="btn btn-big btn-secondary"><strong>7/25日</strong><br><small>库存: 800</small></button>
                        <button class="btn btn-big btn-primary"><strong>7/26日</strong><br><small>库存: 800</small></button>
                      </div> 
                    @else 
                    <button class="btn btn-block disabled btn-success">抢票通道即将开启, 敬请期待!</button>
                    @endif
                    <p></p>
                    <p><small>温馨提示: <br>
                        1. 购票和使用必需阅读并同意<a href="#">《购票协议》</a><br>
                        2. 电子票仅限当日使用,无法退换,不要买错哦<br>
                        3. 本次盛会由 First Meet Gallery x Mooi Design 携手打造,为您呈现无限精彩; 祝您满载而归!</small></p>
                </div>
            </div>
        </div>
        <p></p>
        <div class="card">
            <div class="card-image"><img class="img-responsive" src="{{ asset('images/find.jpg') }}" alt=".."></div>
            <div class="card-body">
                <small>
                    “乘风破浪”的娃友们，重拾起自己沉寂已久的玩心，来遇见让你再次心动不已的玩具吧。在SSF面基群内老友，吐露这段时间的心情；结识新友，创造新的美好回忆；还可以亲口把自己的支持告诉你喜欢的设计师，更重要的是，pick自己喜爱的玩具带回家！
        
                First Meet Gallery携手Mooi Design联合主办，用心为你打造这个夏季最in最high最开心的潮流玩具展，一个属于大人的玩具乐园。多元的潮玩IP，多样的个性玩具，丰富的现场互动，等你参加，准备好加入我们了吗?!
                
                2020年7月25日-7月26日，我们在上海市静安区万航渡路838号柒彩里5层等你来玩~更多精彩内容、一手资讯请关注我们的官方公众账号，敬请期待！<br>
                <cite>- 海上牧云</cite>
                </small>
            </div>
        </div>
        <p></p>
    </div>
    <p></p>
    <p></p>
    <div class="card-image"><img class="img-responsive" src="{{ asset('images/bjbs.jpg') }}" alt=".."></div>
        
</div>

<script type="text/javascript">
    var t = '2020/07/25 19:00:00';
    $('#getting-started').countdown(t, function(event) {
      $(this).html(event.strftime('%w 周 %d 天 %H:%M:%S'));
    });
  </script>
@endsection
