@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <div class="panel">
        <div class="panel-header text-center">
        <figure class="avatar avatar-lg bg-gray"><img src="{{ asset('custom/avatar.png') }}" alt="Avatar"></figure>
        <div class="panel-subtitle">1399882662</div>
        </div>
        <div class="panel-body">
        <div class="p-centered">
            <div class="form-group">
                <label class="form-label" for="input-example-1"><i class="fa fa-envelope-o" aria-hidden="true"></i> 验证码已发送！<span id="retry"></span></label>
                <input class="form-input" type="text" id="input-example-1" placeholder="请输入6位数字验证码" autofocus>
            </div>
            <p></p>
            <button class="btn btn-primary btn-block">注册并开始使用</button>
        </div>
        </div>
        <div class="panel-footer">

        </div>
    </div>
    </div>
</div>

<script>
    var rate = 120;
    if(typeOf(window.localStorage.rate)=='undefined' )
    function count(){
        rate--;
        localStorage.setItem(“rate”,rate);
        console.log(rate);
    }

    setInterval("count()", 1000);
</script>

@endsection
