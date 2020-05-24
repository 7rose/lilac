@extends('../nav')

@section('main')

<div class="nav-pad"></div>
<p></p>
    <div class="container col-sm-8 col-xs-12 p-centered">

        <div class="columns col-gapless">
            <div class="column col-xs-4 text-center mt-2">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/gift.svg') }}" alt="...">
                </figure>
                <p>抽奖</p>
            </div>
            <div class="column col-xs-4 text-center mt-2">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/expo.svg') }}" alt="...">
                </figure>
                <p>会展</p>
            </div>
            <div class="column col-xs-4 text-center mt-2">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/customer.svg') }}" alt="...">
                </figure>
                <p>客户</p>
            </div>
            <div class="column col-xs-4 text-center mt-2">
                <a href="/users" class="text-dark">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/users.svg') }}" alt="...">
                </figure>
                <p>用户</p>
                </a>
            </div>
            <div class="column col-xs-4 text-center mt-2">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/task.svg') }}" alt="...">
                </figure>
                <p>事务</p>
            </div>
            <div class="column col-xs-4 text-center mt-2">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/finance.svg') }}" alt="...">
                </figure>
                <p>财务</p>
            </div>
            <div class="column col-xs-4 text-center mt-2">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/config.svg') }}" alt="...">
                </figure>
                <p>系统设置</p>
            </div>
            <div class="column col-xs-4 text-center mt-2">
                <figure class="avatar avatar-lg bg-gray">
                    <img src="{{ asset('images/service.svg') }}" alt="...">
                </figure>
                <p>客服</p>
            </div>


        </div>
</div>

@endsection
