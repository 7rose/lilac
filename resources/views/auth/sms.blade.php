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
                    <input class="form-input mt-2 mobile" id="mobile" name="mobile" type="number" placeholder="请输入手机号" autofocus>
                    <p id="info" name="mobile" class="form-input-hint"></p>
                    <p>
                        <div class="form-group">
                            <label class="form-checkbox">
                                <input id="terms" type="checkbox" checked onchange="javascript:terms()">
                                <i class="form-icon"></i> 阅读并同意 <a href="#">《用户协议》</a>
                                <p id="info" name="terms" class="form-input-hint"></p>
                            </label>
                        </div>
                    </p>
                    <button onclick="javascript:getcode()" id="next" class="btn btn-primary btn-block mt-2" type="button">获取验证码</button>
                    </div>
                </form>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal modal-sm" id="md"><a class="modal-overlay" href="#modals-sizes" aria-label="Close"></a>
    <div class="modal-container" role="document">
      <div class="modal-header"><a class="btn btn-clear float-right" href="#modals-sizes" aria-label="Close"></a>
        <div class="modal-title"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> 验证</div>
      </div>
      <div class="modal-body">
        <div class="content">
          <form>
            <div class="form-group">
              <input id="code" class="form-input mobile text-success" id="input-example-7" type="text" placeholder="验证码">
              <p id="code_info" name="code" class="form-input-hint"></p>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button id="check_code" class="btn btn-primary btn-block" onclick="javascript:check()">验证并开始使用</button>
      </div>
    </div>
  </div>

<script>
    var rate, counter, error_info;

    var path = window.location.pathname;
    // Agree items
    function terms()
    {
        var agree = $("#terms").is(':checked');
        if(!agree) {
            $("#next").attr('disabled',true);
        }else{
            $("#next").attr('disabled',false);
        }
    }

    // check mobile & code
    function check()
    {
        var code = $("#code").val();
        var mobile = $("#mobile").val();

        if(!(/^\d{6}$/.test(code))){
            $("#code_info").html("验证码是6位数字");
            // $("#code_info").addClass('text-error');
            return false;
        }

        $.ajax({
            type:"POST",
            url:"/check",
            data:{
                mobile: mobile,
                code: code
            },
            datatype: "json",
            beforeSend:function(){
                $("#code_info").html("");
                // $("#check_code").attr('disabled', true);
                // $("#check_code").addClass('loading');
            },
            success:function(data, statusTest, xhr){
                var msg = jQuery.parseJSON(data);

                if(msg.hasOwnProperty('errors')) {
                    $.each(msg.errors, function(key, value) {
                        $('p[name ="'+key+'"]').html(value);
                    });
                    return false;
                }
                window.location.replace(path);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                error(jqXHR, textStatus, errorThrown);
            }
        });
    }

    // get SMS code
    function getcode()
    {
        var mobile = $("#mobile").val();
        var terms = $("#terms").val();

        if(!(/^1[3456789]\d{9}$/.test(mobile))){
            $("#info").html("手机号不正确");
            return false;
        }

        $.ajax({
            type:"POST",
            url:"/code",
            data:{
                mobile: mobile,
                terms: terms
            },
            datatype: "json",
            beforeSend:function(){
                $("#mobile").attr('disabled', true);
                $("#terms").attr('disabled', true);
                $("#next").attr('disabled', true);
                $("#next").addClass('loading');
            },
            success:function(data, statusTest, xhr){
                var d = $.parseJSON(data);
                rate = d.rate;
                error_info = '验证码发送成功, <a href="#md">现在验证</a>';
                counter = setInterval(counter_timer, 1000);
                setTimeout(show,1800);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                error(jqXHR, textStatus, errorThrown);
                reset_form();
            }
        });
    }

    // error handler
    function error(jqXHR, textStatus, errorThrown)
    {
        var headers = toJson(jqXHR.getAllResponseHeaders());

        if(headers.hasOwnProperty('x-ratelimit-reset')) {
            var now = parseInt(Date.now()/1000);
            rate = headers["x-ratelimit-reset"] - now;
            error_info = "收到验证码约需2分钟, 请勿频繁获取";
            counter = setInterval(counter_timer, 1000);
        }else{
            var msg = jQuery.parseJSON(jqXHR.responseText);

            console.log(msg);

            if(msg.hasOwnProperty('errors')) {
                $.each(msg.errors, function(key, value) {
                    $('p[name ="'+key+'"]').html(value);
                });
            }else{
                $("#info").html("无法获取服务");
            }
            // reset_form();
        }
    }

    function counter_timer()
    {
        rate --;

        // $("#info").addClass('text-error');
        $("#info").html(error_info);

        $("#next").html(rate + " 秒后可重新获取");
        $("#next").removeClass('loading');

        if(rate <= 0) {
            reset_all();
            clearInterval(counter);
        }
    }

    // show modal
    function show()
    {
        window.location.replace("#md");
    }

    // rest form
    function reset_form()
    {
        // $("#info").html("");
        $("#code").html("");
        $("#next").html("获取验证码");

        $("#mobile").prop('disabled', false);
        $("#terms").prop('disabled', false);
        $("#next").prop('disabled', false);
        $("#next").removeClass('loading');
    }

    function reset_all()
    {
        $("#info").html("");
        reset_form();
    }

    // trans headers to JSON
    function toJson(string)
    {
        var headers = {};
        string.trim()
            .split(/[\r\n]+/)
            .map(value => value.split(/: /))
            .forEach(keyValue => {
                headers[keyValue[0].trim()] = keyValue[1].trim();
            });
        return headers;
    }

</script>
@endsection
