@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="columns p-centered container">
    @if(isset($expos) && count($expos))
    <div class="column col-6 col-xs-12">
        <div class="card">
            <div class="card-image"><img class="img-responsive" src="{{ asset('images/cover.jpg') }}" alt=".."></div>
            <div class="card-body">
                {{ show($expo->info, 'title') }}<br>
                {{ show($expo->info, 'addr') }}<br>
                {{ $expo->begin }}<br>
                {{ $expo->end }}<br>
            </div>

            <div class="card-footer">
                <div class="btn-group btn-group-block">
                <a class="btn btn-primary" href="/pay/1">25日票</a>
                <a class="btn" href="/pay/2">26日票</a>
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="empty">
        <div class="nav-pad"></div>
      <div class="empty-icon"><h1><i class="fa fa-envelope-o" aria-hidden="true"></i></h1></div>
      <p class="empty-subtitle">暂时没有展会发布, 若您需要了解情况或者寻求合作,请联系hi@mooibay.com, 谢谢!</p>
      <div class="empty-action">
        <a href="/me" class="btn btn-primary">&nbsp;&nbsp;个人中心&nbsp;&nbsp;</a>
      </div>
      <div class="nav-pad"></div>
    </div>
    @endif

</div>
@endsection
