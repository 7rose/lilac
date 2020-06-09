@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12">
    @if (isset($ticket))
    <div class="card">
      <div class="card-image"><img class="img-responsive" src="{{ asset('images/expo-s.jpg') }}" alt="macOS Sierra"></div>
      <div class="qrcode">
        <div class="visible-print text-center p-centered">
            @isset($url)
            {!! QrCode::size(120)->color(60,68,82)->margin(1)->generate($url) !!}
            @endisset
        </div>
      </div>
      <div class="card-header">
        <button class="btn btn-primary float-right"><i class="fa fa-refresh" aria-hidden="true"></i></button>
      <div class="card-title h5">{{ show($ticket->expo->info, 'title') }}&nbsp;&nbsp; ¥ {{ show($ticket->expo->info, 'price') }}</div>
        <div class="card-subtitle text-gray">{{ \Carbon\Carbon::parse($ticket->expo->begin)->diffForHumans() }}后开展</div>
      </div>
      <div class="card-body">
          <i class="fa fa-map-pin" aria-hidden="true"></i> {{ show($ticket->expo->info, 'addr') }}<br>
          {{ $ticket->expo->begin }} 至 {{ $ticket->expo->end }}
    </div>
    </div>
    @else

    @endif
  </div>

@endsection
