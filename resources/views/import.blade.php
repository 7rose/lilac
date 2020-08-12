@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<section>
    <div class="column">
        <p></p>
        <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
            <div class="panel">
                <div class="panel-header">
                    <span class="text-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></span> Excel导入
                </div>
            <div class="panel-body">
                <form method="POST" action="/import/save_order" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group @error('excel') has-error @enderror">
                        <div class="col-3 col-sm-12">
                        <label class="form-label" for="input-example-1">Excel文件</label>
                        </div>
                        <div class="col-9 col-sm-12">
                        <input class="form-input" type="file" name="excel" required>
                        @error('excel')
                            <p class="form-input-hint">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>

                    <p></p>
                    <button class="btn btn-primary btn-block mt-2" type="submit">导入</button>
                </form>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
