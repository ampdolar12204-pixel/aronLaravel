<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    @if(session('user'))
      <a class="navbar-brand" href="{{ route('home') }}">Project Manager</a>
    @else
      <a class="navbar-brand" href="#">Project Manager</a>
    @endif
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    @if(!session('user'))
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
      </ul>
    </div>
    @elseif(session('user') === 'admin')

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#logout">Log out</a>
        
        </li>
      </ul>
    </div>

    @else
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/perdashboard">{{session('user')->name}}'s Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" data-bs-toggle="modal" data-bs-target="#logout">Log out</a>
      </ul>
    </div>
    @endif
  </div>
  
  <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
          <div class="modal-header bg-warning">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Log Out</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              You are about to logout, proceed?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a class="btn btn-danger" aria-current="page" href="{{ route('logout') }}">Log out</a>
          </div>
          </div>
      </div>
  </div>
</nav>