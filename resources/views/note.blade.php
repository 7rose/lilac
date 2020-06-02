@extends('../nav')

@section('main')
<div class="column col-12">
    <div class="empty">
    <div class="nav-pad"></div>
      <div class="empty-icon"><h1 class="text-{{ isset($conf['icon_color']) ? $conf['icon_color'] : 'dark' }}"><i class="fa fa-{{ isset($conf['icon']) ? $conf['icon'] : 'check' }}" aria-hidden="true"></i></h1></div>
      <p class="empty-subtitle">{!! isset($conf['msg']) ? $conf['msg'] : '操作已成功!' !!}</p>
      <div class="empty-action">
        <a href="/{{ isset($conf['btn_link']) ? $conf['btn_link'] : 'apps' }}" class="btn btn-{{ isset($conf['btn_color']) ? $conf['btn_color'] : 'primary' }}">&nbsp;&nbsp; {{ isset($conf['btn_text']) ? $conf['btn_text'] : '应用中心' }} &nbsp;&nbsp;</a>
      </div>
      <div class="nav-pad"></div>
    </div>
</div>
@endsection
