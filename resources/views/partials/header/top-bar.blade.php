<nav id="top-bar" class="top-bar nav">
    <div class="container">

        <div class="nav-right">

            <a class="nav-item vcu" href="{{ route( 'chatter.home' ) }}">
                Forum
            </a>

            <a class="nav-item vcu" href="https://vcu.teamfemr.org/" target="_blank">
                VCU
            </a>

            <a class="nav-item" href="https://www.facebook.com/Team-Femr-1839194879645777/" target="_blank">
              <span class="icon">
                <i class="fa fa-facebook-f"></i>
              </span>
            </a>

            <a href="#slack" v-scroll-to="'#slack'"  class="nav-item {{ Route::currentRouteName() == 'pages.slack' ? 'is-active' : '' }}">
              <span class="icon">
                <i class="fa fa-slack"></i>
              </span>
            </a>

            <a class="nav-item" href="https://github.com/FEMR/femr" target="_blank">
              <span class="icon">
                <i class="fa fa-github"></i>
              </span>
            </a>

            @if( Auth::check() )

                <span class="nav-item is-hidden-mobile logged-in-status">

                    Welcome {{ Auth::user()->name }}

                    @if( Auth::user()->is_admin )
                    |
                    <a class="nav-item logged-in-status" href="{{ route( 'admin.dashboard.index' ) }}">
                      Admin
                    </a>
                    @endif

                    |
                    {!! Form::open([ 'method' => 'POST', 'route' => 'logout' ]) !!}
                        <button class="nav-item logout-button" href="{{ url('/logout') }}">Logout</button>
                    {!! Form::close() !!}

                </span>

            @else
                <a class="nav-item is-hidden-mobile" href="{{ route( 'register' ) }}">
                    Register
                </a>

                <a class="nav-item is-hidden-mobile" href="{{ route( 'login' ) }}">
                    Login
                </a>

            @endif

        </div>

    </div>

</nav>
