@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-6 col-xs-12">
    <div class="panel">
      <div class="panel-header text-center">
        <div class="panel-title h5 mt-10">{{ show($expo->info, 'title', '') }}</div>
      <div class="panel-subtitle">票价: ¥{{ show($expo->info, 'price', '') }}</div>
      </div>
      <nav class="panel-nav">
        <ul class="tab tab-block">
          <li class="tab-item active"><a href="#panels"><i class="fa fa-map-o" aria-hidden="true"></i> </a></li>
          <li class="tab-item"><a href="#panels"><i class="fa fa-ticket" aria-hidden="true"></i> </a></li>
          <li class="tab-item"><a href="#panels"><i class="fa fa-gift" aria-hidden="true"></i> </a></li>
        </ul>
      </nav>
      <div class="panel-body">
        <div class="tile tile-centered">
          <div class="tile-content">
            <div class="tile-title text-bold">地址</div>
            <div class="tile-subtitle">{{ show($expo->info, 'addr', '') }}</div>
          </div>
        </div>
        <div class="tile tile-centered">
          <div class="tile-content">
            <div class="tile-title text-bold">开始时间 </div>
            <div class="tile-subtitle">{{ $expo->begin }} <span class="text-primary">[{{ \Carbon\Carbon::parse($expo->begin)->diffForHumans() }}]</span></div>
          </div>
        </div>
        <div class="tile tile-centered">
          <div class="tile-content">
            <div class="tile-title text-bold">结束时间</div>
            <div class="tile-subtitle">{{ $expo->end }} <span class="text-primary">[{{ \Carbon\Carbon::parse($expo->end)->diffInHours(\Carbon\Carbon::parse($expo->begin), true) }}小时]</div>
          </div>
        </div>
        <div class="tile tile-centered">
            <div class="tile-content">
                <div class="tile-title text-bold">负责人</div>
                <div class="tile-subtitle">{{ $expo->end }}</div>
            </div>
        </div>
        <div class="tile tile-centered">
            <div class="tile-content">
                <div class="tile-title text-bold">检票员</div>
                <div class="tile-subtitle">{{ $expo->end }}</div>
            </div>
        </div>
      </div>
      <div class="panel-footer">
        <button class="btn btn-primary btn-block">更新</button>
      </div>
    </div>
  </div>
  @endsection
