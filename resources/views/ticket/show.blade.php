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
        <div class="modal-title h5">Modal title</div>
      </div>
      <div class="modal-body">
        <div class="content">
          iyuj
        </div>
      </div>
      <div class="modal-footer">
        确定
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
</script>

@endsection
