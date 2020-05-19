@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<section>
    <div class="column">
        <p></p>
        <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
            <div class="panel">
                <div class="panel-header">
                    <p><i class="fa fa-key" aria-hidden="true"></i> 身份验证</p>
                </div>
            <div class="panel-body">

                <!-- contents -->
                <form method="POST" action="/code">
                    @csrf
                    <input class="form-input mt-2" name="mobile" type="number" id="mobile" placeholder="请输入手机号" required="required" autofocus>
                    <p>
                        <div class="form-group">
                            <label class="form-checkbox">
                                <input id="agree" type="checkbox" checked onchange="javascript:check()">
                                <i class="form-icon"></i> 阅读并同意 <a href="#">《用户协议》</a>
                            </label>
                        </div>
                    </p>
                    <button id="next" class="btn btn-primary btn-block mt-2" type="submit">获取验证码</button>
                    </div>
                </form>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function check()
    {
        var agree = $("#agree").is(':checked');
        if(!agree) {
            $("#next").attr('disabled',true);
        }else{
            $("#next").attr('disabled',false);
        }
    }
</script>
@endsection
