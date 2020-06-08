@extends('nav')

@section('main')
<div class="columns">
    <div class="column">
        @if ($expo)
        <div class="hero hero-lg bg-primary">
            <div class="hero-body">
                <h1>{{ show($expo->info, 'title', '') }}</h1>
                <p>{{ $expo->begin }} - {{ $expo->end }} </p>
                <p>{{ show($expo->info, 'addr', '') }}</p>
                <a href="/expo/order/{{$expo->id}}" class="btn"><i class="fa fa-magic" aria-hidden="true"></i> 立即抢票</a>
            </div>
        </div>
        @else
        <div class="empty">
            <div class="nav-pad"></div>
          <div class="empty-icon"><h1><i class="fa fa-coffee" aria-hidden="true"></i></h1></div>
          <p class="empty-subtitle"><strong>暂时没有展会发布</strong> </p>
          <p>您可以联络 hi@mooibay.com 获取资讯或者洽商合作, 谢谢!</p>
          <div class="empty-action">
            <a href="#" class="btn btn-primary">&nbsp;&nbsp;我要订阅&nbsp;&nbsp;</a>
          </div>
          <div class="nav-pad"></div>
        </div>
        @endif
    </div>
</div>
@endsection
