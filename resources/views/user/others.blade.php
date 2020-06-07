
@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12 p-centered">
    <div class="panel">
      <div class="panel-header">
          <div class="panel-title">

            <div class="input-group col-xs-7 float-right">
                <input class="form-input input-sm" type="text" id="key_word" placeholder="关键词" required>
                <button class="btn btn-primary input-group-btn btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
      </div>
      <div class="panel-body">
    @if(isset($users) && count($users))
        @foreach ($users as $user)
            <div class="columns">
            <div class="column">
                <a href="/user/{{ $user->id }}" class="text-dark">
                <div class="chip">
                    @if (face($user)->avatar)
                    <figure class="avatar avatar-sm"> <img src="{{ asset(face($user)->avatar) }}"  alt="Avatar">
                    @else
                    <figure class="avatar avatar-sm" data-initial="{{ face($user)->avatar_text }}">
                    @endif

                    </figure>
                    {{ face($user)->name }}
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

                </div>
            </div>
        @endforeach
    @else
    <div class="empty">
        <div class="empty-icon"><h1><i class="fa fa-spinner" aria-hidden="true"></i></h1></div>
        <p class="empty-subtitle">还没有记录</p>
    </div>
    @endif
      </div>
      <div class="panel-footer">

      </div>
    </div>
  </div>
@endsection
