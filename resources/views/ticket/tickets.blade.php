@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <a href="/expos/create" class="btn btn-secondary btn-block"><i class="fa fa-magic" aria-hidden="true"></i> 发布</a>
    <p></p>
    @if (isset($tickets) && count($tickets))
        @foreach ($tickets as $e)
        <div class="tile tile-centered">
            <div class="tile-content">
            <div class="tile-title">{{ show($e->info, 'title', '') }}{!!$e->on ? ' <span class="text-success">[上线购票中!]</span>' : '' !!}</div>
            <small class="tile-subtitle text-gray">{{ $e->begin }} - {{ $e->end }}</small>
            <small class="tile-subtitle"><i class="fa fa-map-marker" aria-hidden="true"></i> {{ show($e->info, 'addr', '') }}</small>
            </div>
            <div class="tile-action">
            <a class="btn btn-link" href="/expo/{{ $e->id }}">
                <h5><i class="fa fa-angle-double-right" aria-hidden="true"></i></h5>
            </a>
            </div>
        </div>
        <div class="divider"></div>
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
