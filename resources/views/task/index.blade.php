<?php
    function showName($parts)
    {
        $new = [];
        foreach ($parts as $p) {
            $user = App\User::find($p['id']);
            $add = Arr::add($p, 'name', face($user)->name);
            $new[] = $add;
        }
        return $new;
    }
?>
@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<section>
    <div class="column">
        <p></p>
        <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
            <div class="panel">
                <div class="panel-header">
                    <a href="/app" class="text-dark"><i class="fa fa-clock-o" aria-hidden="true"></i>  所有任务</a>
                </div>
            <div class="panel-body">
                <p></p>
                @if($records->count())
                    @foreach ($records as $r)
                    <a href="/task/show/{{ $r->id }}" class="text-dark">
                        <div class="card mt-2">
                        <div class="tile tile-centered">
                            <div class="tile-content">
                                <div class="tile-title">&nbsp;&nbsp; {{ $r->title }}
                                </div>
                                <small class="tile-subtitle">&nbsp;&nbsp;&nbsp;  {{ $r->content }}</small><br>
                                <small class="tile-subtitle">&nbsp;&nbsp;&nbsp; 
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $r->date }} &nbsp;
                                    [{{ \Carbon\Carbon::parse($r->date)->diffForHumans() }}]
                                </small><br>

                                @foreach (showName($r->parts) as $s)
                                    <small class="tile-subtitle">&nbsp;&nbsp;&nbsp; {{ $s['name'] }} : {{ $s['task'] }}</small>
                                @endforeach
                                
                            </div>
                        @if($r->confirmed || $r->abandon)
                            @if($r->abandon)
                            <span class="btn btn-gray btn-sm">已作废</span>&nbsp;
                            @endif

                            @if($r->confirmed)
                            <span class="btn btn-success btn-sm">已完成</span>&nbsp;
                            @endif
                        @else
                            <a href="/task/confirmed/{{ $r->id }}" class="btn btn-success btn-sm">已确认</a>&nbsp;
                            <a href="/task/abandon/{{ $r->id }}" class="btn btn-danger btn-sm">!作废</a>&nbsp;
                        @endif
                        
                        </div>
                    </div>
                    </a>
                    @endforeach 
                @else
                <div class="hero text-center">
                    <div class="hero-body">
                        <h1><i class="fa fa-jpy" aria-hidden="true"></i></h1>
                        <p>尚无任务记录</p>
                    </div>
                </div>
                @endif
                <p></p>
            </div>
            <div class="p-centered">{{ $records->links() }} </div>
        </div>
    </div>
</section>
@endsection
