@extends('../nav')

@section('main')

<div class="nav-pad"></div>
<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/apps" class="btn btn-link text-dark"><i class="fa fa-th" aria-hidden="true"></i></a>
            </li>
            <li class="breadcrumb-item">
              <a href="/users">用户</a>
            </li>
            <li class="breadcrumb-item">
                {{ face($user)->name }}
            </li>
        </ul>

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
                <li class="tab-item {{ isset($user->tickets) && count($user->tickets) ?  '' : 'active'}}">
                    <a href="#">资料</a>
                </li>
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
                    @if(isset($vcard) && $vcard !='')
                    <div class="visible-print text-center p-centered">
                        {!! QrCode::size(260)->color(60,68,82)->generate($vcard); !!}
                    </div>
                    @endif
                <div class="tile tile-centered">
                  <div class="tile-content">
                    <div class="tile-title text-bold">邮件</div>
                    <div class="tile-subtitle">{{ show($user->ids, 'email.addr', 'hi@mooibay.com') }}</div>
                  </div>
                  <div class="tile-action">
                    <button class="btn btn-link btn-action btn-lg"><i class="icon icon-edit"></i></button>
                  </div>
                </div>
                <div class="tile tile-centered">
                    <div class="tile-content">
                      <div class="tile-title text-bold">职务</div>
                        <div class="tile-subtitle">
                            @if (isset($user->conf['roles']) && count($user->conf['roles']))
                                @foreach ($user->conf['roles'] as $r)
                                @if(isset($r['org']) && $r['org']->show)
                                    <span class="chip">
                                        {{ $r['org']->info['name'] }}
                                        @if(isset($r['role']) && $r['role']->show)
                                        : {{ $r['role']->info['name'] }}
                                        @endif
                                    </span>
                                @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="tile-action">

                    </div>
                </div>
                </div>
                <div class="panel-footer">
                @can('update', $user, $user)
                <a class="btn btn-primary btn-block" href="/update/{{ $user->id }}"> 更新</a>
                @endcan

                @can('lock-user',$user)
                @if($user->locked)
                    <a class="btn btn btn-success btn-block mt-2" href="/unlock/{{ $user->id }}"> 解锁</a>
                @else
                    <a class="btn btn-secondary btn-block mt-2" href="/lock/{{ $user->id }}"> 锁定</a>
                @endif
                @endcan
                </div>
            </li>
            <li>
                <div class="panel-body">
                @if (isset($user->tickets) && count($user->tickets))
                    @foreach ($user->tickets as $t)
                    <div class="tile tile-centered">
                        <div class="tile-content">
                        <div class="tile-title">{{ show($t->expo->info, 'title') }}&nbsp;&nbsp; ¥ {{ show($t->expo->info, 'price') }}

                        </div>
                        <small class="tile-subtitle text-gray">
                            <i class="fa fa-mobile" aria-hidden="true"></i> {{ show($t->user->ids, 'mobile.number') }} / No.{{ $t->id }}
                            @if(!empty($t->sorted))
                            <span class="label label-success">入场次序: {{ $t->sorted }}</span>
                            @endif
                            @if($t->used)
                            <span class="label label-primary">已检</span>
                            @endif
                        </small><br>
                        <small class="tile-subtitle"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $t->expo->begin }}</small>
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
            <li>没有异常的订单</li>
        </ul>

        </div>
    </div>
</div>

@endsection
