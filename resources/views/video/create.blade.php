@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<section>
    <div class="column">
        <p></p>
        <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
            <div class="panel">
                <div class="panel-header">
                    <a href="/apps" class="text-dark"><i class="fa fa-clock-o" aria-hidden="true"></i>  视频发布</a>
                </div>
            <div class="panel-body">
                <form method="POST" action="/task/next">
                    @csrf


                  <div class="form-group @error('title') has-error @enderror">
                    <div class="col-3 col-sm-12">
                    <label class="form-label" for="input-example-1">标题</label>
                    </div>
                    <div class="col-9 col-sm-12">
                    <input class="form-input" type="text" name="title" maxlength="32" placeholder="标题" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="form-input-hint">{{ $message }}</p>
                    @enderror
                    </div>
                </div>


                <div class="form-group @error('content') has-error @enderror">
                    <div class="col-3 col-sm-12">
                    <label class="form-label" for="input-example-1">简介</label>
                    </div>
                    <div class="col-9 col-sm-12">
                    <input class="form-input" type="text" name="content" maxlength="200" placeholder="简介" value="{{ old('content') }}" required>
                    @error('content')
                        <p class="form-input-hint">{{ $message }}</p>
                    @enderror
                    </div>
                </div>

                <div class="form-group @error('video') has-error @enderror">
                    <div class="col-3 col-sm-12">
                    <label class="form-label" for="input-example-1">视频文件</label>
                    </div>
                    <div class="col-9 col-sm-12">
                    <input class="form-input" type="file" name="video" minlength="3" maxlength="200" placeholder="视频文件" value="{{ old('video') }}" required>
                    @error('video')
                        <p class="form-input-hint">{{ $message }}</p>
                    @enderror
                    </div>
                </div>
                
                    <p></p>
                    <button class="btn btn-primary btn-block mt-2" type="submit">下一步</button>
                </form>
                <p></p>
            </div>
        </div>
    </div>
</section>
@endsection
