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
                    <a href="/tasks" class="text-dark"><i class="fa fa-clock-o" aria-hidden="true"></i>  所有任务</a>
                </div>
            <div class="panel-body">
                <p></p>
                @isset($record)
                    <div class="card mt-2">
  
                        <div class="card-header"><h5>{{ $record->title }}</h5>
                            @if($record->confirmed || $record->abandon)
                                @if($record->abandon)
                                <span class="label label-gray label-sm">X已作废</span>&nbsp;
                                @endif

                                @if($record->confirmed)
                                <span class="label label-success label-sm">已完成</span>&nbsp;
                                @endif
                            @else
                                <a href="/task/confirmed/{{ $record->id }}" class="btn btn-success btn-sm">确认</a>&nbsp;
                                <a href="/task/abandon/{{ $record->id }}" class="btn btn-danger btn-sm">!作废</a>&nbsp;
                            @endif
                        </div>
                        <div class="card-body">
                                {{ $record->content }}<br>
                            
                                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $record->date }} &nbsp;
                                [{{ \Carbon\Carbon::parse($record->date)->diffForHumans() }}]
                            <br>

                            @foreach (showName($record->parts) as $s)
                                {{ $s['name'] }} : {{ $s['task'] }}<br>
                            @endforeach
                            <div class="divider"></div>
                            <p></p>
                            <div class="timeline">
                                
                                @foreach (timeline($record->log) as $key)
                                <div class="timeline-item" id="timeline-example-2">
                                    <div class="timeline-left"><a class="timeline-icon icon-lg tooltip" href="#timeline-example-2" data-tooltip="{{ \Carbon\Carbon::parse($key['time']) }}"><i class="icon icon-check"></i></a></div>
                                    <div class="timeline-content">
                                      <div class="tile">
                                        <div class="tile-content">
                                          <p class="tile-subtitle">{{ \Carbon\Carbon::parse($key['time']) }}</p>
                                          <p> <a href="/user/{{ $key['id'] }}">{{ face(App\User::find($key['id']))->name }}</a>: {{ $key['do'] }}</p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                                
                            </div>

                        </div>

                    </div>
                @else
                <div class="hero text-center">
                    <div class="hero-body">
                        <h1><i class="fa fa-jpy" aria-hidden="true"></i></h1>
                        <p>尚无任务记录</p>
                    </div>
                </div>
                @endisset
                <p></p>
            </div>
        </div>
    </div>
</section>
@endsection
