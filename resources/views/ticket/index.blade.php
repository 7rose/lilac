@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
        @if (isset($tickets) && count($tickets))
        @foreach ($tickets as $t)
        <p></p>
        <div class="card ticket-main">
            <div class="tile tile-centered ticket-content">
                <div class="tile-content">
                <div class="tile-title">{{ show($t->expo->info, 'title') }}&nbsp;&nbsp; ¥ {{ show($t->expo->info, 'price') }}</div>
                <small class="tile-subtitle text-gray"><i class="fa fa-mobile" aria-hidden="true"></i> {{ show($t->user->ids, 'mobile.number') }} / No.{{ $t->id }}</small><br>
                <small class="tile-subtitle"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $t->expo->begin }} <br> {{ $t->expo->end }}</small>
            </div>
            <div class="tile-action">
                    <img src="{{ asset('images/line.svg') }}" alt="" class="ticket-line">
                    <a class="btn btn-link" href="/ticket/{{ $t->id }}">
                        <h5><i class="fa fa-qrcode" aria-hidden="true"></i></h5>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div class="empty">
        <div class="empty-icon"><h1><i class="fa fa-spinner" aria-hidden="true"></i></h1></div>
        <p class="empty-subtitle">还没有记录</p>
    </div>
    @endif


    <div class="p-centered">{{ $tickets->links() }} </div>
    </div>
    <div>
    </div>
</div>

@endsection
