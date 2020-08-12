<?php
    function tr($record)
    {
        switch ($record) {
            case 'out':
                # code...
                return ['color' => "error", 'text'=>'支出'];
                break;

            case 'in':
                # code...
                return ['color' => "success", 'text'=>'收入'];
                break;

            case 'trans':
                # code...
                return ['color' => "warning", 'text'=>'内部划转'];
                break;
            
            default:
                # code...
                break;
        }
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
                    <a href="/app" class="text-dark"><i class="fa fa-jpy" aria-hidden="true"></i> 财务</a>
                </div>
                <ul class="tab tab-block">
                    <li class="tab-item">
                        <a href="/finance/create">登记</a>
                    </li>
    
                    <li class="tab-item active">
                        <a href="/finance/log">日志</a>
                    </li>
                    <li class="tab-item">
                      <a href="/finance/dash">统计</a>
                  </li>
                </ul>
            <div class="panel-body">
                <p></p>
            @if($records->count())
                @foreach ($records as $r)
                    <div class="card mt-2">
                    <div class="tile tile-centered">
                        <div class="tile-content">
                            <div class="tile-title">&nbsp;&nbsp; <span class="text-{{ tr($r->type)['color'] }}">¥ {{ $r->fee }}</span>  &nbsp;&nbsp;
                                <small> <span class="label label-{{ tr($r->type)['color'] }}">{{ tr($r->type)['text'] }}</span></small>

                                @if($r->invoice)
                                    &nbsp;<small> <span class="label label-success">发票</span></small>
                                @endif

                                @if($r->contract)
                                    &nbsp;<small> <span class="label label-success">合同</span></small>
                                @endif
                            </div>
                            <small class="tile-subtitle">&nbsp;&nbsp;&nbsp; <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $r->date }}</small><br>
                            <small class="tile-subtitle">&nbsp;&nbsp;&nbsp; {{ empty($r->user_from) ? show($r->from, 'val') : face($r->user_from)->name }}</small>
                            ->
                            <small class="tile-subtitle">&nbsp;&nbsp;{{ empty($r->user_to) ? show($r->to, 'val') : face($r->user_to)->name }}; {{ $r->for }}</small>
                        </div>
                    @if($r->confirmed || $r->abandon)
                        @if($r->abandon)
                        <span class="label label-gray">X已作废</span>&nbsp;
                        @endif
                    @else
                        <a href="/finance/confirmed/{{ $r->id }}" class="btn btn-success btn-sm">已核对</a>&nbsp;
                        <a href="/finance/abandon/{{ $r->id }}" class="btn btn-danger btn-sm">!作废</a>&nbsp;
                    @endif
                    
                    </div>
                </div>
                @endforeach 
            @else
            <div class="hero text-center">
                <div class="hero-body">
                    <h1><i class="fa fa-jpy" aria-hidden="true"></i></h1>
                    <p>尚无财务信息</p>
                </div>
            </div>
            @endif
            <p></p>
            <div class="p-centered">{{ $records->links() }} </div>
            </div>
        </div>
    </div>
</section>
@endsection
