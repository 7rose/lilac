@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<div class="container">
    <p></p>
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <div class="btn-group btn-group-block">
        <a href="/expos/create" class="btn">+ 发布</a>
        <a href="/import/order" class="btn btn-primary">导入排序</a>
    </div> 
    <p></p>
    @if (isset($expos) && count($expos))
        @foreach ($expos as $e)
        <div class="tile tile-centered">
            <div class="tile-content">
            <div class="tile-title">{{ show($e->info, 'title', '') }}{!!$e->on && $e->end > now() ? ' <span class="text-success">[上线购票中!]</span>' : '' !!}</div>
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

    @endif


    <div class="p-centered">{{ $expos->links() }} </div>
    </div>
    <div>
    </div>
</div>

@endsection
