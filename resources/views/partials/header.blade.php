<nav class="nav has-shadow">

    <div class="nav-left">
        <span class="nav-item">
            <img src="{{ asset('images/logo/logo_color_med.png') }}" alt="Team fEMR Logo">
        </span>
        <a href="{{ route( 'pages.home' ) }}" class="nav-item {{ Route::currentRouteName() == 'pages.home' ? 'is-active' : '' }}">
            Home
        </a>
        <a href="{{ route( 'pages.news' ) }}" class="nav-item {{ Route::currentRouteName() == 'pages.news' ? 'is-active' : '' }}">
            News
        </a>

        <a href="{{ route( 'pages.emr' ) }}" class="nav-item {{ Route::currentRouteName() == 'pages.emr' ? 'is-active' : '' }}">
            EMR
        </a>
    </div>

    <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
    <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
    <span class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
    </span>


    <!-- This "nav-menu" is hidden on mobile -->
    <!-- Add the modifier "is-active" to display it on mobile -->
    <div class="nav-right nav-menu">



        <a href="{{ route( 'pages.slack' ) }}" class="nav-item {{ Route::currentRouteName() == 'pages.slack' ? 'is-active' : '' }}">
          <span class="icon">
            <i class="fa fa-slack"></i>
          </span>
        </a>

        <a class="nav-item" href="https://github.com/FEMR/femr" target="_blank">
          <span class="icon">
            <i class="fa fa-github"></i>
          </span>
        </a>

        <span class="nav-item">

          <a class="button is-primary">
            <span class="icon">
              <i class="fa fa-heart"></i>
            </span>
            <span>Donate</span>
          </a>

        </span>

        @if (Auth::check())
            <span class="nav-item">Welcome {{ Auth::user()->name }}</span>
            <span class="nav-item"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></span>
        @else
            <span class="nav-item"><a href="{{ url('/login') }}">Login</a></span>
            <span class="nav-item"><a href="{{ url('/register') }}">Register</a></span>
        @endif

    </div>
</nav>