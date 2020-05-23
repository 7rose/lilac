@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12">
    <div class="panel">
      <div class="panel-header">
          <div class="panel-title">
            <span>牧云</span>
            <div class="input-group col-xs-7 float-right">
                <input class="form-input input-sm" type="text" placeholder="关键词"">
                <button class="btn btn-primary input-group-btn btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
        <li class="divider" data-content="mooibay.com">
      </div>
      <div class="panel-body">
        @foreach ($users as $user)
            <div class="columns">
            <div class="column">
                <a href="/user/{{ $user->id }}" class="text-dark">
                <div class="chip">
                    @if (show($user->ids, 'wechat.avatar'))
                    <figure class="avatar avatar-sm"> <img src="{{ asset(show($user->ids, 'wechat.avatar')) }}"  alt="Avatar">
                    @else
                    <figure class="avatar avatar-sm" data-initial="{{ Str::substr(show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname', '*'))), 0,1) }}">
                    @endif

                    </figure>{{ show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname', '*'))) }}
                </div>
                </a>
                @if ($user->locked)
                <div class="float-right"><span class="text-warning"><i class="fa fa-coffee" aria-hidden="true"></i></span></div>
                @else
                <div class="float-right"><span class="text-success"><i class="fa fa-clock-o" aria-hidden="true"></i></span></div>
                @endif
                <li class="divider">
            </div>
            <div class="divider-vert"></div>
            <div class="column">
                @if (isset($user->roles) && count($user->roles))
                <span class="chip">
                    @foreach ($user->roles as $role)
                        @if($role->show)
                        {{ show($role->info, 'name', show($role->info, 'full_name', '')) }}
                        @endif
                    @endforeach
                </span>
                </div>
                @endif
            </div>
        @endforeach
      </div>
      <div class="panel-footer">

      </div>
    </div>
  </div>
@endsection
