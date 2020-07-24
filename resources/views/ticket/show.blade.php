@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12 p-centered">
    @if (isset($ticket))
    <div class="card">
      <div class="card-image"><img class="img-responsive" src="{{ asset('images/ticket-cover.jpg') }}" alt="macOS Sierra"></div>
      <div class="qrcode">
        <div class="visible-print text-center p-centered">
            @if(isset($url) && $url)
            {!! QrCode::size(120)->color(60,68,82)->margin(1)->generate($url) !!}
            @else
            <img src="{{ asset('images/void.svg') }}" alt="void" class="void_svg" />
            @endif
        </div>
      </div>
      <div class="card-header">
      <button onclick="javascript:refresh()" class="btn btn-success float-right {{ $ticket->expo->end < \Carbon\Carbon::now()  ? 'disabled' : '' }}"><i class="fa fa-refresh" aria-hidden="true"></i></button>
        <p>
            @if(!empty($ticket->sorted))
            <span class="label label-success"><strong>入场次序: {{ $ticket->sorted }}</strong></span>
            @endif
            @if($ticket->used)
            <span class="label label-primary">已检</span>
            @endif
        </p>
        <p><a href="/expos/notice">请务必阅读《参展规则》！</a></p>
      <div class="card-title h5">{{ show($ticket->expo->info, 'title') }}</div>
        <div class="card-subtitle text-gray">ID.{{ $ticket->id }} | ¥ {{ show($ticket->expo->info, 'price') }}</div>
      </div>
      <div class="card-body">
          <span class="text-success"><i class="fa fa-map-pin" aria-hidden="true"></i></span> {{ show($ticket->expo->info, 'addr') }}<br>
          <span class="text-{{ $ticket->expo->end < \Carbon\Carbon::now()  ? 'error' : 'success' }}"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
          {{ $ticket->expo->begin }} ({{ \Carbon\Carbon::parse($ticket->expo->begin)->diffForHumans() }}{{ $ticket->expo->end < \Carbon\Carbon::now()  ? ' ,已过期' : '' }})
    </div>

    <div class="card-footer">
        <p>
        @if(times($ticket->logs))
        <a href="#modal_confirm" class="btn btn-secondary btn-block {{ $ticket->used || $ticket->expo->end < \Carbon\Carbon::now()  ? 'disabled' : '' }}">
             赠送给他人
        </a>
        @else
        <a href="#modal_confirm" class="btn btn-secondary btn-block disabled">
            此票已超过最大转让次数
       </a>
        @endif
        </p>

        <div class="divider"></div>
        @if (count($ticket->logs))
        <div class="timeline">
                @foreach (timeline($ticket->logs) as $log)
                <div class="timeline-item" id="timeline-example-1">
                    <div class="timeline-left"><a class="timeline-icon tooltip" href="#timeline-example-1" data-tooltip="{{ \Carbon\Carbon::parse($log['time']) }}"></a></div>
                    <div class="timeline-content">
                      <div class="tile">
                        <div class="tile-content">
                          <span class="text-gray">{{ date('Y-m-d H:i:s', $log['time']) }}</span> &nbsp;&nbsp;
                            <i class="fa fa-hand-o-right" aria-hidden="true"></i> {{ $log['do'] }}

                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
            </div>
        @endif


    </div>
    </div>

    @else

    @endif
  </div>

  <div class="modal" id="modal_confirm">
    <a href="#close" class="modal-overlay" aria-label="Close"></a>
    <div class="modal-container">
      <div class="modal-header">
        <a href="#close" class="btn btn-clear float-right" aria-label="Close"></a>
        <div class="modal-title h5">温馨提示</div>
      </div>
      <div class="modal-body">
        <div class="content">
            <div class="toast toast-warning">
            您正在赠送此票! <br>您需要了解并同意以下6项:<br>
            1. 票赠送成功以后无法撤销!<br>
            2. 受赠人必须已经关注 MOOI海上牧云。<br>
            3. 受赠人手机号输入错误的，票可能无法找回。<br>
            4. 本系统不支持付费转让。<br>
            5. 每位客户同一场展会最多拥有2张票, 您可能需要与受赠方确认,否则可能赠送失败。<br>
            6. 每张票最多可以赠送2次,当前剩余{{ times($ticket->logs) }}次!<br>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" id="ticket_id" value="{{ $ticket->id }}"/>
        <input class="form-input mt-2 mobile" id="mobile" name="mobile" minlength="11" maxlength="11" type="number" placeholder="受赠人手机号.." required>
        <p id="info" name="mobile" class="form-input-hint"></p>
        <div class="form-group text-left">
            <label class="form-checkbox text-left">
                <input id="terms" type="checkbox" checked onchange="javascript:terms()">
                <i class="form-icon"></i> 我已阅读并清楚其风险</a>
                <p id="info" name="terms" class="form-input-hint text-primary"></p>
            </label>
        </div>
        <a href="javascript:trans()" id="next" class="btn btn-primary btn-block">确定赠送</a>
      </div>
    </div>
  </div>

<script>
    window.onload = function(){
        // 　counter = setInterval(refresh, 50000); // 50秒
    }

    function refresh()
    {
        window.location.reload();
    }

    function terms()
    {
        var agree = $("#terms").is(':checked');
        if(!agree) {
            $("#next").attr('disabled',true);
        }else{
            $("#next").attr('disabled',false);
        }
    }

    function trans()
    {
        var id = $("#ticket_id").val();
        var mobile = $("#mobile").val();
        var terms = $("#terms").val();

        if(!(/^1[3456789]\d{9}$/.test(mobile))){
            $("#info").html("手机号不正确");
            return false;
        }

        var url = "/ticket/trans/" + id;

        $.ajax({
            type:"POST",
            url: url,
            data:{
                mobile: mobile,
                terms: terms
            },
            datatype: "json",
            beforeSend:function(){
                $("#code_info").html("");
                // $("#next").attr('disabled', true);
                // $("#next").addClass('loading');
            },
            success:function(data, statusTest, xhr){
                var msg = jQuery.parseJSON(data);

                if(msg.hasOwnProperty('errors')) {
                    $.each(msg.errors, function(key, value) {
                        $('p[name ="'+key+'"]').html(value);
                    });
                    return false;
                }
                window.location.href = "/me";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('p[name ="mobile"]').html('系统没有响应');
            }
        });
    }

</script>

@endsection
