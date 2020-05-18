@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<p></p>
<div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
<div class="hero bg-gray">
    <div class="hero-body text-center">
        <h1><i class="fa fa-space-shuttle" aria-hidden="true"></i> </h1>
        <p>验证码接收时间应需2分钟, 请稍后重试</p>
        <p>
            <a href="/sms" class="btn">再去试试</a>
        </p>
    </div>
</div>
</div>
<?php
    $a = Request::header();
    var_dump($a);
?>
@endsection
