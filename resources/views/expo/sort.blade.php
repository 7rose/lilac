@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
        <div class="panel">
            <div class="panel-header">
              <div class="panel-title h6">{{ show($expo->info, 'title') }}</div>
            </div>
            <div class="panel-body">
                <ul class="nav">
                    <li class="nav-item active">
                      <span>基本信息</span>
                      <ul class="nav">
                        <li class="nav-item">
                          <span>地址: {{ show($expo->info, 'addr') }}</span>
                        </li>
                        <li class="nav-item">
                        <span>开展时间: {{ $expo->begin }}</span>
                        </li>
                        <li class="nav-item">
                          <span>结束时间: {{ $expo->end }}</span>
                        </li>
                      </ul>
                    </li>
                    <li class="nav-item active">
                        <span>统计</span>
                        <ul class="nav">
                          <li class="nav-item">
                          已售票: <span class="text-success">{{ $expo->tickets->count() }} / {{ show($expo->info, 'limit', '*') }}</span>
                          </li>
                          <li class="nav-item">
                          已检票: <span class="text-primary">{{ $expo->tickets->reject(function ($key) { return !$key->used; }) }} </span>
                          </li>
                          <li class="nav-item">
                          已登记次序: <span class="text-primary">{{ $expo->tickets->reject(function ($key) { return empty($key->sort); }) }} </span>
                          </li>
                        </ul>
                      </li>
                    <li class="nav-item">
                      <span>Components</span>
                    </li>
                    <li class="nav-item">
                      <span>Utilities</span>
                    </li>
                  </ul>
            </div>
            <div class="panel-footer">
              <div class="input-group">
                <input class="form-input" type="text" name="mix" placeholder="票id,顺序号..">
                <button class="btn btn-primary input-group-btn">登记</button>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection
