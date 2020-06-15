@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12">
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
        <button onclick="javascript:refresh()" class="btn btn-success float-right"><i class="fa fa-refresh" aria-hidden="true"></i></button>
      <div class="card-title h5">{{ show($ticket->expo->info, 'title') }}&nbsp;&nbsp; ¥ {{ show($ticket->expo->info, 'price') }}</div>
        <div class="card-subtitle text-gray">No.{{ $ticket->id }} | ¥ {{ show($ticket->expo->info, 'price') }}</div>
      </div>
      <div class="card-body">
          <span class="text-success"><i class="fa fa-map-pin" aria-hidden="true"></i></span> {{ show($ticket->expo->info, 'addr') }}<br>
          <span class="text-success"><i class="fa fa-clock-o" aria-hidden="true"></i></span> {{ $ticket->expo->begin }} ({{ \Carbon\Carbon::parse($ticket->expo->begin)->diffForHumans() }})
    </div>

    <div>
        <div class="timeline">
            <div class="timeline-item" id="timeline-example-1">
              <div class="timeline-left"><a class="timeline-icon tooltip" href="#timeline-example-1" data-tooltip="March 2016"></a></div>
              <div class="timeline-content">
                <div class="tile">
                  <div class="tile-content">
                    <p class="tile-subtitle">March 2016</p>
                    <p class="tile-title">Initial commit</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="timeline-item" id="timeline-example-2">
              <div class="timeline-left"><a class="timeline-icon icon-lg tooltip" href="#timeline-example-2" data-tooltip="February 2017"><i class="icon icon-check"></i></a></div>
              <div class="timeline-content">
                <div class="tile">
                  <div class="tile-content">
                    <p class="tile-subtitle">February 2017</p>
                    <p class="tile-title">New Documents experience</p>
                    <p class="tile-title"><a href="components.html#bars">Bars</a>: represent the progress of a task</p>
                    <p class="tile-title"><a href="components.html#steps">Steps</a>: progress indicators of a sequence of task steps</p>
                    <p class="tile-title"><a href="components.html#tiles">Tiles</a>: repeatable or embeddable information blocks</p>
                  </div>
                  <div class="tile-action">
                    <button class="btn">View</button>
                  </div>
                </div>
              </div>
            </div>

          </div>


    </div>
    </div>

    @else

    @endif
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
