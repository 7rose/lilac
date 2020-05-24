<!DOCTYPE html>
<html lang="{{ $app->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('custom/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/font-awesome.min.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <title>海上牧云</title>
</head>
<body>
    <header class="navbar navi container bg-gray">
        <section class="navbar-section">
            <a href="/"><img src="{{ asset('custom/logo.svg') }}"  class="logo hide-xs" /></a>
            <a href="/apps" class="btn btn-link show-xs text-dark"><i class="fa fa-th" aria-hidden="true"></i></a>
        </section>
        <section class="navbar-center">
            <a href="/"><img src="{{ asset('custom/logo.svg') }}" class="logo show-xs p-centered" /></a>
        </section>
        <section class="navbar-section">
            <a href="/apps" class="btn btn-link hide-xs text-dark">应用中心</a>
            <a href="#" class="btn btn-link hide-xs text-dark">配置</a>
            @auth
            <div class="dropdown dropdown-right">
                <a class="dropdown-toggle text-dark" tabindex="0">
                    <div class="chip">
                        @if (show(Auth::user()->ids, 'wechat.avatar'))
                        <figure class="avatar avatar-sm bg-gray"><img src="{{ asset(show(Auth::user()->ids, 'wechat.avatar', 'custom/avatar.png')) }}"  alt="Avatar"></figure>
                        @else
                        <figure class="avatar avatar-sm" data-initial="{{ Str::substr(show(Auth::user()->info, 'nick', show(Auth::user()->info, 'name', show(Auth::user()->ids, 'wechat.nickname', '*'))), 0,1) }}"></figure>
                        @endif

                        {{ show(Auth::user()->info, 'public') ? show(Auth::user()->info, 'name', show(Auth::user()->info, 'nick', show(Auth::user()->ids, 'wechat.nickname', '*'))) :  show(Auth::user()->info, 'nick', show(Auth::user()->info, 'name', show(Auth::user()->ids, 'wechat.nickname', '*'))) }}
                    </div>
                </a>
                <ul class="menu text-left">
                    <li class="menu-item">
                    <a href="/me">我</a>
                        <div class="menu-badge">
                            <label class="form-switch">
                                <input id="pub" name="pub" type="checkbox" {{ show(Auth::user()->info, 'public') ? "checked" : '' }} onclick="javascript:pub()">
                                <i class="form-icon"></i> 公开
                            </label>
                        </div>
                    </li>
                  <li class="menu-item"><a href="/expos">展会和票务</a></li>
                  <li class="divider"></li>
                  <li class="menu-item"><a href="/ad">我的推荐码</a></li>
                  <li class="divider"></li>
                  <li class="menu-item"><a href="/logout"><i class="fa fa-power-off" aria-hidden="true"></i> 安全退出</a></li>
                </ul>
            </div>
            @else
            <a href="/sms" class="btn btn-link text-dark"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
            @endauth
        </section>
    </header>

    @yield('main')

    <footer class="footer text-center">
        <div class="nav-pad"></div>
        <small class="text-gray">
            &copy; {{ now()->year }}, 上海牧云玩具设计有限公司<br>
                <a class="text-gray" href="http://beian.miit.gov.cn">沪ICP备20011997号-1</a>
        </small>
    </footer>

</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var path = window.location.pathname;

    function pub()
    {
        var checked = $("#pub").is(':checked');

        $.ajax({
            type:"POST",
            url:"/pub",
            data:{
                pub: checked
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
</html>
