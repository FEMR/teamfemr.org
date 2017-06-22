<nav class="nav has-shadow">

    <div class="nav-left">
        <a href="/" class="nav-item">
            <img src="{{ asset('images/logo/logo_color_med.png') }}" alt="Team fEMR Logo">
        </a>

        <a href="#search" class="nav-item">
            Search
        </a>
        <a href="#about-femr" class="nav-item">
            About
        </a>

        <a href="#open-source" class="nav-item">
            Open Source
        </a>

        <a href="#news" class="nav-item">
            News
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

        <a href="#" class="nav-item">
          <span class="icon">
            <i class="fa fa-dollar"></i>
          </span>
        </a>

        <a href="#" class="nav-item">
          <span class="icon">
            <i class="fa fa-facebook-f"></i>
          </span>
        </a>

        <a href="#slack" class="nav-item {{ Route::currentRouteName() == 'pages.slack' ? 'is-active' : '' }}">
          <span class="icon">
            <i class="fa fa-slack"></i>
          </span>
        </a>

        <a class="nav-item" href="https://github.com/FEMR/femr" target="_blank">
          <span class="icon">
            <i class="fa fa-github"></i>
          </span>
        </a>

        {{--<span class="nav-item">--}}

          {{--<a class="button is-primary">--}}
            {{--<span class="icon">--}}
              {{--<i class="fa fa-heart"></i>--}}
            {{--</span>--}}
            {{--<span>Donate</span>--}}
          {{--</a>--}}

        {{--</span>--}}

        @if (Auth::check())
            {{--<span class="nav-item">Welcome {{ Auth::user()->name }}</span>--}}
            <span class="nav-item">

              <a  class="button is-small" href="{{ route( 'admin.dashboard.index' ) }}">Admin</a>

            </span>
            {{--<span class="nav-item">--}}
                {{--{!! Form::open([ 'method' => 'POST', 'route' => 'logout' ]) !!}--}}
                {{--<button class="button" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</button>--}}
                {{--{!! Form::close() !!}--}}
            {{--</span>--}}
        @else
            {{--<span class="nav-item"><a href="{{ url('/login') }}">Login</a></span>--}}
            {{--<span class="nav-item"><a href="{{ url('/register') }}">Register</a></span>--}}
        @endif

    </div>
</nav>