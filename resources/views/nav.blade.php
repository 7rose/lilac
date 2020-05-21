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
            <a href="/test" class="btn btn-link show-xs text-dark"><i class="fa fa-th" aria-hidden="true"></i></a>
        </section>
        <section class="navbar-center">
            <a href="/"><img src="{{ asset('custom/logo.svg') }}" class="logo show-xs p-centered" /></a>
        </section>
        <section class="navbar-section">
            <a href="/test" class="btn btn-link hide-xs text-dark">应用中心</a>
            <a href="#" class="btn btn-link hide-xs text-dark">配置</a>
            @auth
            <div class="dropdown dropdown-right">
                <a class="dropdown-toggle" tabindex="0">
                    <div class="chip bg-gray">
                        @isset(Auth::user()->ids->wechat->avatar)
                        <img src="{{ asset(Auth::user()->ids->wechat->avatar) }}"  class="avatar avatar-sm">
                        @else
                        <img src="{{ asset('custom/avatar.png') }}"  class="avatar avatar-sm">
                        @endisset
                        Goldern
                    </div>
                </a>
                <ul class="menu text-left">
                  <li class="menu-item"><a href="#">Slack</a></li>
                  <li class="menu-item"><a href="#">Hipchat</a></li>
                  <li class="menu-item"><a href="#">Skype</a></li>
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
