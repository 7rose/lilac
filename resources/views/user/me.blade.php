@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
        <div class="panel">
          <div class="panel-header text-center">
            <figure class="avatar avatar-lg"><img src="../img/avatar-2.png" alt="Avatar"></figure>
            <div class="panel-title h5 mt-10">Bruce Banner</div>
            <div class="panel-subtitle">THE HULK</div>
          </div>
          <nav class="panel-nav">
            <ul class="tab tab-block">
              <li class="tab-item active"><a href="#panels">Profile</a></li>
              <li class="tab-item"><a href="#panels">Files</a></li>
              <li class="tab-item"><a href="#panels">Tasks</a></li>
            </ul>
          </nav>
          <div class="panel-body">
            <div class="tile tile-centered">
              <div class="tile-content">
                <div class="tile-title text-bold">E-mail</div>
                <div class="tile-subtitle">bruce.banner@hulk.com</div>
              </div>
              <div class="tile-action">
                <button class="btn btn-link btn-action btn-lg tooltip tooltip-left" data-tooltip="Edit E-mail"><i class="icon icon-edit"></i></button>
              </div>
            </div>
            <div class="tile tile-centered">
              <div class="tile-content">
                <div class="tile-title text-bold">Skype</div>
                <div class="tile-subtitle">bruce.banner</div>
              </div>
              <div class="tile-action">
                <button class="btn btn-link btn-action btn-lg"><i class="icon icon-edit"></i></button>
              </div>
            </div>
            <div class="tile tile-centered">
              <div class="tile-content">
                <div class="tile-title text-bold">Location</div>
                <div class="tile-subtitle">Dayton, Ohio</div>
              </div>
              <div class="tile-action">
                <button class="btn btn-link btn-action btn-lg"><i class="icon icon-edit"></i></button>
              </div>
            </div>
          </div>
          <div class="panel-footer">
            <button class="btn btn-primary btn-block">Save</button>
          </div>
        </div>
    </div>
</div>

@endsection
