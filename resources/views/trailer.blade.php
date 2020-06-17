@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="columns p-centered container">
    @if(isset($expos) && count($expos))
    <div class="column col-6 col-xs-12">
        <div class="card">
            <div class="card-image"><img class="img-responsive" src="{{ asset('images/cover.jpg') }}" alt=".."></div>


            <div class="card-footer">
                <div class="btn-group btn-group-block">
                <a class="btn btn-primary" href="/pay/1">25日票</a>
                <a class="btn" href="/pay/2">26日票</a>
                </div>
            </div>
            <div class="card-body">
                这个夏天我们已经等待了太久，心里的那个爱玩玩具的小朋友早已蠢蠢欲动。是时候释放童心，和小伙伴们相约，一起来到2020 SSF夏季展现场。<br>

“乘风波浪”的娃友们，重拾起自己沉寂已久的玩心，来遇见让你再次心动不已的玩具吧。在SSF面基群内老友，吐露这段时间的心情；结识新友，创造新的美好回忆；还可以亲口把自己的支持告诉你喜欢的设计师。更重要的是，pick自己喜爱的玩具带回家！<br>

First meet gallery携手MOOI DESIGN联合主办，用心为你打造这个夏季最in最high最开心的潮流玩具展，一个属于大人的玩具乐园。多元的潮玩IP，多样的个性玩具，丰富的现场互动，等你参加，准备好加入我们了吗?!<br>

2020年7月25日-7月26日，我们在上海市静安区万航渡路838号柒彩里5层等你来玩~更多精彩内容、一手资讯请关注我们的官方公众账号，敬请期待！<br>
            </div>
        </div>
    </div>

    @else
    <div class="empty">
        <div class="nav-pad"></div>
      <div class="empty-icon"><h1><i class="fa fa-envelope-o" aria-hidden="true"></i></h1></div>
      <p class="empty-subtitle">暂时没有展会发布, 若您需要了解情况或者寻求合作,请联系hi@mooibay.com, 谢谢!</p>
      <div class="empty-action">
        <a href="/me" class="btn btn-primary">&nbsp;&nbsp; 个人中心 &nbsp;&nbsp;</a>
      </div>
      <div class="nav-pad"></div>
    </div>
    @endif

</div>
@endsection
