@extends('nav')

@section('main')
<div class="column col-12">
    <div class="empty">
        <div class="nav-pad"></div>
      <div class="empty-icon"><h1><i class="fa fa-ban" aria-hidden="true"></i></h1></div>
      <p class="empty-subtitle">需要授权, 若需继续请联系管理员</p>
      <div class="empty-action">
        <a href="/apps" class="btn btn-primary">&nbsp;&nbsp;应用中心&nbsp;&nbsp;</a>
      </div>
      <div class="nav-pad"></div>
    </div>
</div>
@endsection
