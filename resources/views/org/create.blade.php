@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<section>
    <div class="column">
        <p></p>
        <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
            <div class="panel">
                <div class="panel-header">
                    <a href="/expos" class="text-dark"><i class="fa fa-code-fork" aria-hidden="true"></i> 新机构</a>
                    <div class="toast toast-warning mt-2">

                        您正在为 [{{ show($org->info, 'name') }}] 添加下属机构; 此操作有可能会对业务安全性造成严重影响,请谨慎!

                      </div>
                </div>
            <div class="panel-body">
                <form method="POST" action="/org/store">
                    @csrf
                    <div class="form-group @error('key') has-error @enderror">
                        <div class="col-3 col-sm-12">
                            <label class="form-label" for="input-example-1">key</label>
                        </div>
                        <div class="col-9 col-sm-12">
                            <input class="form-input" type="text" name="key" minlength="3" maxlength="16" placeholder="key" value="{{ old('key') }}" onkeyup="this.value=this.value.replace(/[^\w_]/g,'');" required>
                            @error('key')
                            <p class="form-input-hint">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('name') has-error @enderror">
                        <div class="col-3 col-sm-12">
                            <label class="form-label" for="input-example-1">名称</label>
                        </div>
                        <div class="col-9 col-sm-12">
                            <input class="form-input" type="text" name="name" minlength="3" maxlength="16" placeholder="名称" value="{{ old('name') }}" required>
                            @error('name')
                            <p class="form-input-hint">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input name="id" type="hidden" value="{{ $org->id }}" />

                    <button class="btn btn-primary btn-block mt-2" type="submit">确定</button>
                </form>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
