@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
        @if (isset($tickets) && count($tickets))
        @foreach ($tickets as $t)
        <p></p>
        <div class="card">
            <div class="tile tile-centered">
                <div class="tile-content">
                    <div class="tile-title">&nbsp;&nbsp; {{ show($t->expo->info, 'title') }}&nbsp;&nbsp; </div>
                    <small class="tile-subtitle text-gray">&nbsp;&nbsp; No.{{ $t->id }} | ¥ {{ show($t->expo->info, 'price') }}

                        @if(!empty($t->sorted))
                        <span class="label label-success"># {{ $t->sorted }}</span>
                        @endif

                        @if($t->used)
                        <span class="label label-primary">已检</span>
                        @endif
                    </small><br>
                    <small class="tile-subtitle">&nbsp;&nbsp; <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $t->expo->begin }}</small>
                </div>
            <img src="{{ asset('images/line.svg') }}" alt="" class="ticket-line">
            <div class="tile-action">

                    <a class="btn btn-link btn-lg ticket-btn {{ $t->used ? 'text-gray' : 'text-success' }}" href="/ticket/{{ $t->id }}">
                        <h5 ><i class="fa fa-qrcode" aria-hidden="true"></i> &nbsp;&nbsp; </h5>
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
