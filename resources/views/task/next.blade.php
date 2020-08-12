@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<section>
    <div class="column">
        <p></p>
        <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
            <div class="panel">
                <div class="panel-header">
                    <a href="/app" class="text-dark"><i class="fa fa-clock-o" aria-hidden="true"></i>  事务发布 - 任务分解</a>
                </div>
            <div class="panel-body">
                <form method="POST" action="/task/store">
                    @csrf
                    
                    @foreach ($mc->ok as $m)
                        <div class="form-group @error('{{ $m->id }}') has-error @enderror">
                            <div class="col-3 col-sm-12">
                            <label class="form-label" for="input-example-1">{{ face($m)->name }}</label>
                            </div>
                            <div class="col-9 col-sm-12">
                            <input class="form-input" type="text" name="{{ $m->id }}" maxlength="200" placeholder="任务说明" value="{{ old('title') }}" required>
                            @error('{{ $m->id }}')
                                <p class="form-input-hint">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                    @endforeach

                    <p></p>
                    <button class="btn btn-primary btn-block mt-2" type="submit">下一步</button>
                </form>
                <p></p>
            </div>
        </div>
    </div>
</section>
@endsection
