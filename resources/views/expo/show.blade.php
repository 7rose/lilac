@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <div class="panel">
      <div class="panel-header text-center">
      <div class="panel-title h5 mt-10">{{ show($expo->info, 'title', '') }}  </div>
      <div class="panel-subtitle">票价: ¥{{ show($expo->info, 'price', '') }}{!!$expo->on ? ' <span class="text-success">[上线购票中!]</span>' : '' !!}</div>
      </div>
      <nav class="panel-nav">
        <ul class="tab tab-block">
          <li class="tab-item active"><a href="#panels"><i class="fa fa-map-o" aria-hidden="true"></i> </a></li>
          <li class="tab-item"><a href="#panels"><i class="fa fa-ticket" aria-hidden="true"></i> </a></li>
          <li class="tab-item"><a href="#panels"><i class="fa fa-gift" aria-hidden="true"></i> </a></li>
        </ul>
      </nav>
      <div class="panel-body">
        <div class="tile tile-centered mt-2">
          <div class="tile-content">
            <div class="tile-title text-bold">地址</div>
            <div class="tile-subtitle">{{ show($expo->info, 'addr', '') }}</div>
          </div>
        </div>
        <div class="tile tile-centered mt-2">
          <div class="tile-content">
            <div class="tile-title text-bold">开始时间 </div>
            <div class="tile-subtitle">{{ $expo->begin }} <span class="text-primary">[{{ \Carbon\Carbon::parse($expo->begin)->diffForHumans() }}]</span></div>
          </div>
        </div>
        <div class="tile tile-centered mt-2">
          <div class="tile-content">
            <div class="tile-title text-bold">结束时间</div>
            <div class="tile-subtitle">{{ $expo->end }} <span class="text-primary">[{{ \Carbon\Carbon::parse($expo->end)->diffInHours(\Carbon\Carbon::parse($expo->begin), true) }}小时]</div>
          </div>
        </div>
        <div class="tile tile-centered mt-2">
            <div class="tile-content">
                <div class="tile-title text-bold">负责人</div>
                <div class="tile-subtitle">

                @if (count(pick(show($expo->conf, 'manager'))->ok))

                        @foreach (collect(pick(show($expo->conf, 'manager'))->ok)->values()->unique()->all() as $user)
                        <div class="chip">
                            @if (face($user)->avatar)
                            <figure class="avatar avatar-sm"> <img src="{{ asset(face($user)->avatar) }}"  alt="Avatar">
                            @else
                            <figure class="avatar avatar-sm" data-initial="{{ face($user)->avatar_text }}">
                            @endif

                            </figure>
                            {{ face($user)->name }}
                        </div>
                        @endforeach
                @endif


                @if(count(pick(show($expo->conf, 'manager'))->may))
                    @foreach (collect(pick(show($expo->conf, 'manager'))->may)->values()->unique()->all() as $key)
                    <div class="chip bg-dark text-light">
                        {{ $key }}
                    </div>
                    @endforeach
                @endif


                @if(!count(pick(show($expo->conf, 'manager'))->ok) && !count(pick(show($expo->conf, 'manager'))->may))
                    未设置
                @endif


                </div>
            </div>
        </div>
        <div class="tile tile-centered mt-2">
            <div class="tile-content">
                <div class="tile-title text-bold">检票员</div>
                <div class="tile-subtitle">
                @if (count(pick(show($expo->conf, 'checker'))->ok))

                        @foreach (collect(pick(show($expo->conf, 'checker'))->ok)->values()->unique()->all() as $user)
                        <div class="chip">
                            @if (face($user)->avatar)
                            <figure class="avatar avatar-sm"> <img src="{{ asset(face($user)->avatar) }}"  alt="Avatar">
                            @else
                            <figure class="avatar avatar-sm" data-initial="{{ face($user)->avatar_text }}">
                            @endif

                            </figure>
                            {{ face($user)->name }}
                        </div>
                        @endforeach
                @endif


                @if(count(pick(show($expo->conf, 'checker'))->may))
                    @foreach (collect(pick(show($expo->conf, 'checker'))->may)->values()->unique()->all() as $key)
                    <div class="chip bg-dark text-light">
                        {{ $key }}
                    </div>
                    @endforeach
                @endif


                @if(!count(pick(show($expo->conf, 'checker'))->ok) && !count(pick(show($expo->conf, 'checker'))->may))
                    未设置
                @endif
                </div>
            </div>
        </div>

        <div class="tile tile-centered mt-2">
            <div class="tile-content">
                <div class="tile-title text-bold">可以购票</div>
                @if ($expo->end > now())
                <div class="form-group">
                    <label class="form-switch">
                    <input id="expo_id" type="hidden" value="{{ $expo->id }}" />
                    <input type="checkbox" name="allow" id="allow" onclick="javascript:allow()" {{ $expo->on? "checked" : '' }}>
                    <i class="form-icon"></i> 上线并开放购票
                    </label>
                </div>
                @else
                会展已结束
                @endif

            </div>
        </div>

      </div>
      <div>
      </div>
      <div class="panel-footer">
        <button class="btn btn-primary btn-block">更新</button>
      </div>
    </div>
  </div>

<script>
    function allow()
    {
        var checked = $("#allow").is(':checked');
        var expo_id = $("#expo_id").val();
        var url = '/expo/allow/'+expo_id;

        $.ajax({
            type:"POST",
            url: url,
            data:{
                open: checked
            },
            datatype: "json",
            beforeSend:function(){
                // console.log(data);
            },
            success:function(data, statusTest, xhr){
                // var d = $.parseJSON(data);
                // console.log(d.checked);
                window.location.replace(path);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // error(jqXHR, textStatus, errorThrown);
            }
        });

    }
</script>
  @endsection
