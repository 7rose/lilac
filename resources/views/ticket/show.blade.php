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
      <div class="card-title h5">{{ show($ticket->expo->info, 'title') }}&nbsp;&nbsp; #</div>
        <div class="card-subtitle text-gray">No.{{ $ticket->id }} | ¥ {{ show($ticket->expo->info, 'price') }}</div>
      </div>
      <div class="card-body">
          <span class="text-success"><i class="fa fa-map-pin" aria-hidden="true"></i></span> {{ show($ticket->expo->info, 'addr') }}<br>
          <span class="text-{{ $ticket->expo->end < \Carbon\Carbon::now()  ? 'error' : 'success' }}"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
          {{ $ticket->expo->begin }} ({{ \Carbon\Carbon::parse($ticket->expo->begin)->diffForHumans() }}{{ $ticket->expo->end < \Carbon\Carbon::now()  ? ' ,已过期' : '' }})
    </div>

    <div class="card-footer">
        <p>
        <a href="#modal_confirm" class="btn btn-secondary btn-block {{ $ticket->used || $ticket->expo->end < \Carbon\Carbon::now()  ? 'disabled' : '' }}">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 赠送给他人
        </a>
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
                          <span class="text-gray">{{ \Carbon\Carbon::parse($log['time']) }}</span> &nbsp;&nbsp;
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
            <button class="btn btn-clear float-right"></button>
            您正在赠送此票! <br>您需要了解并同意以下几点:<br>
            1. 票赠送成功以后无法撤销!<br>
            2. 受赠人手机号输入错误的, 票可能无法找回<br>
            3. 本系统不支持付费转让<br>
            4. 每张票最多可以赠送2次,当前剩余2次!<br>
            5. 每位客户同一场展会最多拥有2张票, 您可能需要与受赠方确认,否则可能赠送失败
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <input class="form-input mt-2 mobile" id="mobile" name="mobile" minlength="11" maxlength="11" type="number" placeholder="受赠人手机号.." required>
        <p id="info" name="mobile" class="form-input-hint"></p>
        <div class="form-group">
            <label class="form-checkbox p-left">
                <input id="terms" type="checkbox" checked onchange="javascript:terms()">
                <i class="form-icon"></i> 阅读并同意 <a href="#">《用户协议》</a>
                <p id="info" name="terms" class="form-input-hint"></p>
            </label>
        </div>
        <a href="javacript:trans()" id="next" class="btn btn-primary">我完全清楚了, 继续</a>
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
        var mobile = $("#mobile").val();
        var terms = $("#terms").val();

        if(!(/^1[3456789]\d{9}$/.test(mobile))){
            $("#info").html("手机号不正确");
            return false;
        }
    }
</script>

@endsection
