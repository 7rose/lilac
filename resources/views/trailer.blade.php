<?php
    $e = new App\Helpers\Expos;
    $au = new App\Helpers\Authorize;
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
                    <p><i class="fa fa-clock-o" aria-hidden="true"></i> <strong>日期</strong><br>2020年7月25 至 26 日<br>
                        <i class="fa fa-map-marker" aria-hidden="true"></i> <strong>地点</strong><br> 上海市静安区万航渡路838号柒彩里5层</p>
                </div>

                <div class="card-footer">
                    {{-- @if(Auth::check() && ($e->buy(App\Expo::find(1)) || $e->buy(App\Expo::find(2)))) --}}
                    <div class="text-center">
                        <h5>统一票价: ¥130 
                        @if($au->need(Auth::user(), 'board'))
                         <a href="/report" class="text-success"><i class="fa fa-print" aria-hidden="true"></i> </a>
                        @endif
                        </h5>
                    </h5>
                    </div>
                    <p></p>
                    <div class="btn-group btn-group-block btn-big">
                        @if($e->buy(App\Expo::find(1)))
                        <a href="/pay/1" class="btn btn-big btn-secondary"><strong>7月25日</strong><br><small>
                            @if($au->need(Auth::user(), 'staff'))
                            余票: {{ $e->buy(App\Expo::find(1)) }}
                            @else 
                            售票中
                            @endif
                        </small></a>
                        @else
                        <button class="btn btn-big btn-secondary disabled"><strong>7月25日</strong><br><small>已售完</small></button> 
                        @endif

                        @if($e->buy(App\Expo::find(2)))
                        <a href="/pay/2" class="btn btn-big btn-primary"><strong>7月26日</strong><br><small>
                            @if($au->need(Auth::user(), 'staff'))
                            余票: {{ $e->buy(App\Expo::find(2)) }}
                            @else 
                            售票中
                            @endif
                        </small></a>
                        @else
                        <button class="btn btn-big btn-primary disabled"><strong>7月26日</strong><br><small>已售完</small></button> 
                        @endif

                      </div> 
                    {{-- @else 
                    <button class="btn btn-block disabled btn-success"> 购票将于 7月11日 13:00 ({{ \Carbon\Carbon::parse("2020/7/11 13:00")->diffForHumans() }}) 启动 </button>
                    @endif --}}
                    <p></p>
                    <p><small>温馨提示: <br>
                        1. 购票和使用必需阅读并同意<a href="#xieyi">《购票协议》</a><br>
                        2. 电子票仅限当日使用,无法退换,不要买错哦<br>
                        3. 本次会展将在<code>2020年7月18日 下午1点</code> 在抖音账号“MOOIDESIGN”直播抽取入场顺序号<br>
                        4. 本次会展由 First Meet Gallery x Mooi Design 携手打造,为您呈现无限精彩; 祝您满载而归!</small></p>
                </div>
            </div>
        </div>
        <p></p>
        <div class="card">
            <div class="text-success bg-dark text-center">
                <p></p>
                距离开展
                <div id="getting-started"></div>
                <p></p>
            </div>
        </div>
        <p></p>
        <div class="card">
            <div class="card-header">
                <p class="text-center">部分参展品牌<br>
                    <small class="text-gray">排名不分先后, 动态更新, 欢迎随时关注!</small>
                </p>
            </div>
            <div class="card-image"><img class="img-responsive" src="{{ asset('images/wall.jpg') }}" alt=".."></div>
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

<div class="modal" id="xieyi">
<a href="#close" class="modal-overlay" aria-label="Close"></a>
<div class="modal-container">
    <div class="modal-header">
    <a href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
    <div class="modal-title h5">购票协议</div>
    </div>
    <div class="modal-body">
    <div class="content">

        <p>
            本次会展的展务工作由 上海牧云玩具设计有限公司(以下称:"牧云") 主办, 在其官方公众号 "mooi海上牧云"（以下称：“平台”） 提供售票服务,
            并在展会现场提供检票服务。为保护用户权益，购票者（以下称：“用户”）必需阅读并同意协议所有条款后方可继续；若用户对相关条款有异议，需通过 
            july@mooitoys.com 或平台咨询，其他渠道不予认可。
        </p>
        <h5>会展信息</h5>
        <p>
            1. 以平台公布信息为准。<br>
            2. 牧云可能会根据需要调整相关信息，且可能再不另行通知。<br>
            3. 牧云可能会应上级主管部门要求调整相关信息，且可能不再另行通知。<br>
            4. 因牧云责任的信息调整对用户千万损害的，赔偿金额上限为用户受影响购票实际支付金额。<br>
        </p>
        <h5>票的使用</h5>
        <p>
            1. 门票为电子票，需本人配合微信使用；牧云不另提供纸质票；每场次每位用户限购2张。<br>
            2. 平台为唯一的发票通道；任何专用、额外付费抢票等均为骗局，用户应悉知。<br>
            3. 本电子票为会展入场的唯一身份凭证，因任何原因不能出示此票的，牧云有权拒绝该用户入场。<br>
            4. 为保障全体用户权益，除特殊原因外,牧云不提供退换票服务，请用户酌情购买。<br>
            5. 牧云为到场用户赠送的礼品为免费赠予，用户可自由选择。牧云不就此类赠品提供任何质量和使用保证，也不提供退换服务。<br>
            6. 用户购票后，将在统一的时间（以平台公布为准）抽出入场次序，牧云将使用公开抽取，并实时在系统登记，确保公平性。
            顺序抽取为一次性，且无法改变。公开抽取是确定入场次序唯一的渠道，任何额外付费排序的均为骗局，用户应悉知。<br>
        </p>
        <h5>展会现场</h5>
        <p>
            1. 根据防疫安全要求，现场会设立隔离测温区，届时请根据相关规则依次排队，全程需佩戴口罩参加。<br>
            2. 因防疫主管部门要求，本次活动需控制入场人数，将视情况采取分流制度，望广大玩家配合和理解。<br>
            3. 用户需要自行注意自身和财物的安全，谨防偷、骗，牧云对此不承担责任。<br>
            4. 出于安全考虑，不建议孕妇、老年人及未成年儿童等前往参与；若确需参与，请做好安全防护工作，牧云将尽可能提供协助，保障用户参展体验，
            但不承担任何由此产生的责任。<br>
            5. 用户参展应守法、尊重社会公德及现场相关规定；拒不配合的，牧云有权拒绝其参展，情况严重的，报由公安机关处理。
        </p>
        本协议的解释权归牧云, 牧云有可能对本协议进行修改,且不再另行通知。
        
        <!-- content here -->
    </div>
    </div>
    <div class="modal-footer">
        <a href="#close" class="btn btn-block">同意并关闭</a>
    </div>
</div>
</div>

<script type="text/javascript">
var t = '2020/07/25 10:00:00';
$('#getting-started').countdown(t, function(event) {
    $(this).html(event.strftime('%w 周 %d 天 %H:%M:%S'));
});
</script>
@endsection
