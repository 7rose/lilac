@extends('../nav')

@section('main')

<div class="nav-pad"></div>
<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/apps" class="btn btn-link show-xs text-dark"><i class="fa fa-th" aria-hidden="true"></i></a>
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
          <div class="panel-title h5 mt-10">{{ show($user->info, 'public') ? show($user->info, 'name', show($user->info, 'nick', show($user->ids, 'wechat.nickname', '*'))) :  show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname', '*'))) }}</div>
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
                @isset($vcard)
                <div class="visible-print text-center p-centered">
                    {!! QrCode::size(260)->color(60,68,82)->generate($vcard); !!}
                </div>
                @endisset
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
                        @if (isset($user->roles) && count($user->roles))
                        @foreach ($user->roles as $role)
                        @if($role->show)
                            <span class="chip">
                                {{ show($role->info, 'name', show($role->info, 'full_name', '')) }}
                            </span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="tile-action">
                  <button class="btn btn-link btn-action btn-lg tooltip tooltip-left" data-tooltip="Edit E-mail"><i class="icon icon-edit"></i></button>
                </div>
            </div>
          </div>
          <div class="panel-footer">
            <button class="btn btn-primary btn-block">更新</button>
          </div>
        </div>
    </div>
</div>

@endsection
