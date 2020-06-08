@extends('nav')

@section('main')

<div class="nav-pad"></div>
<p></p>
<div class="container col-sm-8 col-xs-12 p-centered text-center">
    @auth
        <div class="visible-print text-center p-centered">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->errorCorrection('H')->size(260)->merge('/public/custom/avatar.png', .2)->margin(0)->generate($url)) !!} ">
        </div>
        <p>请扫码关注</p>
    @endauth
</div>
