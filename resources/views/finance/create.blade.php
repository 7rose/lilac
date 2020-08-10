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
                  <li class="tab-item active">
                      <a href="/finance/create">登记</a>
                  </li>
  
                  <li class="tab-item">
                      <a href="/finance/log">日志</a>
                  </li>
                  <li class="tab-item">
                    <a href="/finance/dash">统计</a>
                </li>
              </ul>
            <div class="panel-body">
              
            
            <ul data-tabs-content="tabs1">
                <li>
                  {{-- 支出 --}}
                  <form method="POST" action="/finance/store">
                    @csrf

                    <div class="form-group">
                      <label class="form-label">类型
                        @error('type')
                          <span class="text-primary">{{ $message }}</span>
                        @enderror
                      </label>
                      <label class="form-radio">
                        <input type="radio" name="type" value="out">
                        <i class="form-icon"></i> 支出(我开支)
                      </label>
                      <label class="form-radio">
                        <input type="radio" name="type" value="trans">
                        <i class="form-icon"></i> 内部划转(我收到)
                      </label>
                      <label class="form-radio">
                        <input type="radio" name="type" value="in">
                        <i class="form-icon"></i> 收入(我收到外部资金)
                      </label>
                    </div>

                    <div class="form-group @error('date') has-error @enderror">
                      <div class="col-3 col-sm-12">
                      <label class="form-label" for="input-example-1">日期</label>
                      </div>
                      <div class="col-9 col-sm-12">
                      <input class="form-input"type="datetime-local" name="date" value="{{ old('date') }}" placeholder="日期" required>
                      @error('date')
                          <p class="form-input-hint">{{ $message }}</p>
                      @enderror
                      </div>
                  </div>

                    <div class="form-group @error('fee') has-error @enderror">
                      <div class="col-3 col-sm-12">
                      <label class="form-label" for="input-example-1">金额(单位:元)</label>
                      </div>
                      <div class="col-9 col-sm-12">
                      <input class="form-input" name="fee" type="number" min="0.01" max="10000000" step="0.01" value="{{ old('fee') }}" placeholder="金额" required>
                      @error('fee')
                          <p class="form-input-hint">{{ $message }}</p>
                      @enderror
                      </div>
                  </div>

                  <div class="form-group @error('from') has-error @enderror">
                    <div class="col-3 col-sm-12">
                    <label class="form-label" for="input-example-1">来源</label>
                    </div>
                    <div class="col-9 col-sm-12">
                    <input class="form-input" type="text" name="from" placeholder="类型为支出时不填" value="{{ old('from') }}">
                    @error('from')
                        <p class="form-input-hint">{{ $message }}</p>
                    @enderror
                    </div>
                </div>

                    <div class="form-group @error('to') has-error @enderror">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">接收人</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" type="text" name="to" placeholder="类型为内部划转和收入时不填" value="{{ old('to') }}">
                        @error('to')
                            <p class="form-input-hint">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group @error('for') has-error @enderror">
                      <div class="col-3 col-sm-12">
                      <label class="form-label" for="input-example-1">事由</label>
                      </div>
                      <div class="col-9 col-sm-12">
                      <input class="form-input" type="text" name="for" minlength="2" maxlength="200" placeholder="标题" value="{{ old('for') }}" required>
                      @error('for')
                          <p class="form-input-hint">{{ $message }}</p>
                      @enderror
                      </div>
                  </div>

                    <div class="form-group @error('invoice') has-error @enderror">
                        <label class="form-switch">
                        <input type="checkbox" name="invoice" value="{{ old('invoice') }}" >
                        <i class="form-icon"></i> 有发票
                        </label>
                    </div>

                    <div class="form-group @error('contract') has-error @enderror">
                      <label class="form-switch">
                      <input type="checkbox" name="contract" value="{{ old('contract') }}" >
                      <i class="form-icon"></i> 有合同
                      </label>
                  </div>

                    <p></p>
                    <button class="btn btn-primary btn-block mt-2" type="submit">确定</button>
                </form>
                </li>
            </ul>
            </div>
        </div>
    </div>
</section>
@endsection
