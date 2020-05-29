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
                {{ show($user->info, 'public') ? show($user->info, 'name', show($user->info, 'nick', show($user->ids, 'wechat.nickname', '*'))) :  show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname', '*'))) }}
            </li>
        </ul>

        <div class="panel">
            <div class="panel-header text-center">
            @if (show($user->ids, 'wechat.avatar'))
            <figure class="avatar avatar-lg bg-gray"><img src="{{ asset(show($user->ids, 'wechat.avatar', 'custom/avatar.png')) }}"  alt="Avatar"></figure>
            @else
            <figure class="avatar avatar-lg" data-initial="{{ Str::substr(show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname', '*'))), 0,1) }}"></figure>
            @endif

          <div class="panel-title h5 mt-10">
              {{ show($user->info, 'public') ? show($user->info, 'name', show($user->info, 'nick', show($user->ids, 'wechat.nickname', '*'))) :  show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname', '*'))) }}
            @if($user->locked)
                <h2 class="text-warning"><i class="fa fa-lock" aria-hidden="true"></i></h2>
            @endif
            </div>
          <div class="panel-subtitle">{{  show($user->info, 'public') ? show($user->ids, 'mobile.number','') : ''}}</div>
          </div>
          <nav class="panel-nav">
            <ul class="tab tab-block">
              <li class="tab-item active"><a href="#panels"><i class="fa fa-address-card-o" aria-hidden="true"></i></a></li>
              <li class="tab-item"><a href="#panels"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
              <li class="tab-item"><a href="#panels"><i class="fa fa-credit-card" aria-hidden="true"></i></a></li>
              <li class="tab-item"><a href="#panels"><i class="fa fa-bell-o" aria-hidden="true"></i></a></li>
            </ul>
          </nav>
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
        </div>
    </div>
</div>

@endsection
