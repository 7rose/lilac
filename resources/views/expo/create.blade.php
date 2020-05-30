@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<section>
    <div class="column">
        <p></p>
        <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
            <div class="panel">
                <div class="panel-header">
                    <a href="/expos" class="text-dark"><i class="fa fa-map-marker" aria-hidden="true"></i> 会展发布</a>
                </div>
            <div class="panel-body">
                <form method="POST" action="/expos/store">
                    @csrf
                    <div class="form-group">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">标题</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" type="text" name="title" minlength="4" maxlength="12" placeholder="标题" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">地址</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" type="text" name="addr" minlength="6" maxlength="100" placeholder="地址" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">开始时间</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input"type="datetime-local" name="begin" placeholder="开始日期" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">结束时间</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" type="datetime-local" name="end" placeholder="结束日期" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">票价</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" name="price" type="number" min="0" max="1000" step="0.01" placeholder="票价" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">负责人</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" type="text" name="manager" minlength="11" maxlength="110" placeholder="手机号,多人以逗号隔开">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">检票员</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" type="text" name="checker" minlength="11" maxlength="110"  placeholder="手机号,多人以逗号隔开">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-switch">
                        <input type="checkbox" name="open">
                        <i class="form-icon"></i> 发后开放售票
                        </label>
                    </div>
                    <p></p>
                    <button class="btn btn-primary btn-block mt-2" type="submit">发布</button>
                </form>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
