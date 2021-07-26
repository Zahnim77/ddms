@if(Auth::guard('admin')->check())
  <?php 
  $route = "admin.logout"; 
  $name = Auth::guard('admin')->user()->name;
  ?>
@elseif(Auth::guard('company')->check())
  <?php 
  $route = "company.logout"; 
  $name = Auth::guard('company')->user()->name; 
  ?>
@elseif(Auth::guard('web')->check())
  <?php 
  $route = "user.logout"; 
  $name = Auth::guard('web')->user()->name; 
  $user = Auth::guard('web')->user()->id;
  $avatar = Auth::guard('web')->user()->avatar;
  ?>
@endif
<!-- Default Bootstrap navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="{{ url('/') }}">Job Portal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="{{ Request::is('/') ? "active" : ""}}">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="{{ Request::is('view') ? "active" : ""}}">
          @if(Auth::guard('admin')->check())
            <a class="nav-link" href="/view">Jobs(Clientside)</a>
          @else 
            <a class="nav-link" href="/view">Jobs</a>
          @endif
        </li>
        <li class="{{ Request::is('contact') ? "active" : ""}}">
          <a class="nav-link" href="/contact">Contact</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search for a job" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>

      @if(Auth::guard('admin')->check())

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ $name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('jobs.index') }}">All Jobs</a>
            <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
            <a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route($route) }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

          <form id="logout-form" action="{{ route($route) }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>

      @elseif(Auth::guard('company')->check())

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ $name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('company.dashboard') }}">My Jobs</a>
            <a class="dropdown-item" href="/view">All Jobs</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route($route) }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

          <form id="logout-form" action="{{ route($route) }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>

      @elseif(Auth::guard()->check())
      <a class="nav-link" href="{{ route('profile', $user) }}">Profile</a>
      
      <img src="{{ asset('/storage/avatars/'.$avatar) }}" alt="{{ $avatar }}" class="img-fluid rounded-circle" style="height:40px; width:40px;"/>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ $name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('profile', $user) }}">My Profile</a>
            <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route($route) }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

          <form id="logout-form" action="{{ route($route) }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
      @else
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('login') }}">User</a>
          <a class="dropdown-item" href="{{ route('company.login') }}">Company</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Register
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('register') }}">User</a>
          <a class="dropdown-item" href="{{ route('company.register') }}">Company</a>
        </div>
      </li>
      @endif
    </div>
</nav>
