
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
    
                    <li class="tab-item">
                        <a href="/finance/log">日志</a>
                    </li>
                    <li class="tab-item active">
                      <a href="/finance/dash">统计</a>
                  </li>
                </ul>
            <div class="panel-body">
                <p></p>
            @isset($dash)
                <p>
                    <h5>总体</h5>
                    财务记录: {{ $dash['all'] }}<br>
                    作废数: {{ $dash['abandon'] }}<br>
                    总支出(元): {{ $dash['out'] }}<br>
                    总收入(元): {{ $dash['in'] }}
                </p> 

                <p>
                    <h5>今日</h5>
                    财务记录: {{ $dash['all_day'] }}<br>
                    作废数: {{ $dash['abandon_day'] }}<br>
                    总支出(元): {{ $dash['out_day'] }}<br>
                    总收入(元): {{ $dash['in_day'] }}
                </p> 

                <p>
                    <h5>本月</h5>
                    财务记录: {{ $dash['all_month'] }}<br>
                    作废数: {{ $dash['abandon_month'] }}<br>
                    总支出(元): {{ $dash['out_month'] }}<br>
                    总收入(元): {{ $dash['in_month'] }}
                </p> 

                <p>
                    <h5>今年</h5>
                    财务记录: {{ $dash['all_year'] }}<br>
                    作废数: {{ $dash['abandon_year'] }}<br>
                    总支出(元): {{ $dash['out_year'] }}<br>
                    总收入(元): {{ $dash['in_year'] }}
                </p> 

 

            @else
            <div class="hero text-center">
                <div class="hero-body">
                    <h1><i class="fa fa-jpy" aria-hidden="true"></i></h1>
                    <p>尚无财务信息</p>
                </div>
            </div>
            @endisset
            <p></p>
            </div>
        </div>
    </div>
</section>
@endsection

