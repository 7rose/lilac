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
                        <img src="{{ asset(show(Auth::user()->ids, 'wechat.avatar', 'custom/avatar.png')) }}"  class="avatar avatar-sm">
                        {{ show(Auth::user()->info, 'nick', show(Auth::user()->ids, 'wechat.nickname', ' ')) }}
                    </div>
                </a>
                <ul class="menu text-left">
                    <li class="menu-item">
                    <a href="/me"><i class="fa fa-user-circle-o" aria-hidden="true"></i> 我的资料</a>
                        <div class="menu-badge">
                            <label class="form-checkbox">
                                <input type="checkbox">
                                <i class="form-icon"></i> 公开
                            </label>
                        </div>
                    </li>
                  <li class="menu-item"><a href="/expos"> <i class="fa fa-magic" aria-hidden="true"></i> 展会和票务</a></li>
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
</script>
</html>
