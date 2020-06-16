@extends('../nav')

@section('main')
<div class="nav-pad"></div>

<div class="container">
    <div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
        <div class="panel">
            <div class="panel-header">
              <div class="panel-title h6">Comments</div>
            </div>
            <div class="panel-body">
              <div class="tile">
                <div class="tile-icon">
                  <figure class="avatar"><img src="../img/avatar-1.png" alt="Avatar"></figure>
                </div>
                <div class="tile-content">
                  <p class="tile-title text-bold">Thor Odinson</p>
                  <p class="tile-subtitle">Earth's Mightiest Heroes joined forces to take on threats that were too big for any one hero to tackle...</p>
                </div>
              </div>
              <div class="tile">
                <div class="tile-icon">
                  <figure class="avatar"><img src="../img/avatar-2.png" alt="Avatar"></figure>
                </div>
                <div class="tile-content">
                  <p class="tile-title text-bold">Bruce Banner</p>
                  <p class="tile-subtitle">The Strategic Homeland Intervention, Enforcement, and Logistics Division...</p>
                </div>
              </div>
              <div class="tile">
                <div class="tile-icon">
                  <figure class="avatar" data-initial="TS"></figure>
                </div>
                <div class="tile-content">
                  <p class="tile-title text-bold">Tony Stark</p>
                  <p class="tile-subtitle">Earth's Mightiest Heroes joined forces to take on threats that were too big for any one hero to tackle...</p>
                </div>
              </div>
              <div class="tile">
                <div class="tile-icon">
                  <figure class="avatar"><img src="../img/avatar-4.png" alt="Avatar"></figure>
                </div>
                <div class="tile-content">
                  <p class="tile-title text-bold">Steve Rogers</p>
                  <p class="tile-subtitle">The Strategic Homeland Intervention, Enforcement, and Logistics Division...</p>
                </div>
              </div>
              <div class="tile">
                <div class="tile-icon">
                  <figure class="avatar"><img src="../img/avatar-3.png" alt="Avatar"></figure>
                </div>
                <div class="tile-content">
                  <p class="tile-title text-bold">Natasha Romanoff</p>
                  <p class="tile-subtitle">Earth's Mightiest Heroes joined forces to take on threats that were too big for any one hero to tackle...</p>
                </div>
              </div>
            </div>
            <div class="panel-footer">
              <div class="input-group">
                <input class="form-input" type="text" placeholder="Hello">
                <button class="btn btn-primary input-group-btn">Send</button>
              </div>
            </div>
          </div>
    </div>
</div>

@endsection
