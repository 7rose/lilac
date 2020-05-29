<?php

    function role_list($user)
    {
        $out = [];
        if (isset($user->conf['roles']) && count($user->conf['roles'])) {
            foreach ($user->conf['roles'] as $r) {
                $out[] = $r['org']->info['name'].'-'.Arr::get($r['role']->info, 'name');
            }
        }
        return $out;
    }
?>
@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12 p-centered">
    <div class="panel">
      <div class="panel-header">
          <div class="panel-title">
            <span>牧云</span>
            <div class="input-group col-xs-7 float-right">
                <input class="form-input input-sm" type="text" id="key_word" placeholder="关键词" required>
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

                    </figure>
                    {{ show($user->info, 'public') ? show($user->info, 'name', show($user->info, 'nick', show($user->ids, 'wechat.nickname', '*'))) :  show($user->info, 'nick', show($user->info, 'name', show($user->ids, 'wechat.nickname', '*'))) }}
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

                    @if (isset($user->conf['roles']) && count($user->conf['roles']))
                        @foreach ($user->conf['roles'] as $r)
                        @if(isset($r['org']) && $r['org']->show)
                        @if(isset($r['role']) && $r['role']->show)
                                <span class="chip">
                                {{ $r['role']->info['name'] }}
                            </span>
                        @endif
                        @endif
                        @endforeach
                    @endif

                </div>
            </div>
        @endforeach
      </div>
      <div class="panel-footer">

      </div>
    </div>
  </div>
@endsection
