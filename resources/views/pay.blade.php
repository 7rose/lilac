@extends('nav')

@section('main')
<p></p>
<div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <div class="hero bg-gray">
        <div class="hero-body text-center">
        <h1>¥ {{ number_format($info['total_fee']/100, 2) }}</h1>
        <p>您正在购买 {{ $info['body'] }}, 请于5分钟内支付</p>
            <p>
                <a href="javascript:pay()" class="btn btn-success btn-block">确认支付</a>
            </p>
        </div>
    </div>
</div>

<script>
    function pay()
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', <?= $json ?>,
            function(res){
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                        // 使用以上方式判断前端返回,微信团队郑重提示：
                        // res.err_msg将在用户支付成功后返回
                        // ok，但并不保证它绝对可靠。
                        // alert('支付成功');
                        window.location.href="/me";
                }
            }
        );
    }
</script>

@endsection
