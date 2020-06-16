@extends('../nav')

@section('main')

<div class="nav-pad"></div>
<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">

        <div class="panel">
            <div class="panel-header text-center">
            @if (face($user)->avatar)
            <figure class="avatar avatar-lg bg-gray"><img src="{{ face($user)->avatar }}"  alt="Avatar"></figure>
            @else
            <figure class="avatar avatar-lg" data-initial="{{ face($user)->avatar_text }}"></figure>
            @endif

          <div class="panel-title h5 mt-10">
              {{ face($user)->name }}
            @if($user->locked)
                <h2 class="text-warning"><i class="fa fa-lock" aria-hidden="true"></i></h2>
            @endif
            </div>
          <div class="panel-subtitle">{{ face($user)->mobile }}</div>
          </div>
          <nav class="panel-nav">
             <ul class="tab tab-block" data-tabs="tabs1">
                <li class="tab-item {{ isset($user->tickets) && count($user->tickets) ? 'active' : '' }}">
                    <a href="#">票</a>
                </li>
                <li class="tab-item">
                    <a href="#">订单</a>
                </li>
            </ul>
          </nav>

        <ul data-tabs-content="tabs1">
            <li>
                <div class="panel-body">
                @if (isset($user->tickets) && count($user->tickets))
                    @foreach ($user->tickets as $t)
                    <div class="tile tile-centered">
                        <div class="tile-content">
                        <div class="tile-title">{{ show($t->expo->info, 'title') }}&nbsp;&nbsp; ¥ {{ show($t->expo->info, 'price') }}</div>
                        <small class="tile-subtitle text-gray"><i class="fa fa-mobile" aria-hidden="true"></i> {{ show($t->user->ids, 'mobile.number') }} / No.{{ $t->id }}</small><br>
                        <small class="tile-subtitle"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $t->expo->begin }} - {{ $t->expo->end }}</small>
                        </div>
                        <div class="tile-action">
                        <a class="btn btn-link" href="/ticket/{{ $t->id }}">
                            <h5><i class="fa fa-qrcode" aria-hidden="true"></i></h5>
                        </a>
                        </div>
                    </div>
                    <div class="divider"></div>
                    @endforeach
                @else
                <div class="empty">
                    <div class="empty-icon"><h1><i class="fa fa-spinner" aria-hidden="true"></i></h1></div>
                    <p class="empty-subtitle">还没有记录</p>
                </div>
                @endif
                </div>
            </li>
            <li>
                没有异常的订单
            </li>
        </ul>

        </div>
    </div>
</div>

@endsection
