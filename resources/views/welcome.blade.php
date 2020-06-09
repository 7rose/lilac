@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12">
    <div class="card">
      <div class="card-image"><img class="img-responsive" src="{{ asset('images/expo.jpg') }}" alt="macOS Sierra"></div>
      <div class="qrcode">
        <div class="visible-print text-center p-centered">
            {!! QrCode::size(120)->color(60,68,82)->margin(0)->generate('hello'); !!}
        </div>
      </div>
      <div class="card-header">
        <button class="btn btn-primary float-right">ok</button>
        <div class="card-title h5">Google I/O</div>
        <div class="card-subtitle text-gray">Software and hardware</div>
      </div>
      <div class="card-body">An immersive, three-day experience focused on exploring the next generation of technology, mobile and beyond.</div>
    </div>
  </div>

@endsection
