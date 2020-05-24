@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="column col-12">
    <div class="empty">
      <div class="empty-icon"><i class="icon icon-3x icon-mail"></i></div>
      <p class="empty-title h5">You have no new messages</p>
      <p class="empty-subtitle">Click the button to start a conversation</p>
      <div class="empty-action">
        <button class="btn btn-primary">Send a message</button>
      </div>
    </div>
</div>
@endsection
