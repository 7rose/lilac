@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12">
    @if (isset($ticket))
    <div class="card">
      <div class="card-image"><img class="img-responsive" src="{{ asset('images/expo.jpg') }}" alt="macOS Sierra"></div>
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
        <div class="card-subtitle text-gray">No. {{ $ticket->id }} &nbsp;&nbsp;  {{ \Carbon\Carbon::parse($ticket->expo->begin)->diffForHumans() }}后开展</div>
      </div>
      <div class="card-body">
          <span class="text-success"><i class="fa fa-map-pin" aria-hidden="true"></i></span> {{ show($ticket->expo->info, 'addr') }}<br>
          <span class="text-success"><i class="fa fa-clock-o" aria-hidden="true"></i></span> {{ $ticket->expo->begin }} 至 {{ $ticket->expo->end }}
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
