@extends('../nav')

@section('main')
<div class="column col-12">
    <div class="empty">
        <div class="nav-pad"></div>
      <div class="empty-icon"><h1><i class="fa fa-plug" aria-hidden="true"></i></h1></div>
      <p class="empty-subtitle">服务器没有响应</p>
      <div class="empty-action">
        <a href="/me" class="btn btn-primary">&nbsp;&nbsp;个人中心&nbsp;&nbsp;</a>
      </div>
      <div class="nav-pad"></div>
    </div>
</div>
@endsection
