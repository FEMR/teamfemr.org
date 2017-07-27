<nav id="top-bar" class="top-bar nav">
    <div class="container">

        <div class="nav-left is-hidden-mobile">

            {{--<a class="nav-item" href="http://demo.teamfemr.org"target="_blank">--}}
                {{--Demo fEMR--}}
            {{--</a>--}}

            {{--<a class="nav-item" href="{{ asset('/documents/Annual_Report_2014_2015.pdf') }}" target="_blank">--}}
                {{--Annual Report--}}
            {{--</a>--}}

        </div>

        <div class="nav-right">

            <a class="nav-item vcu" href="https://vcu.teamfemr.org/" target="_blank">
              {{--<span class="icon">--}}
                {{--<i class="fa fa-facebook-f"></i>--}}
              {{--</span>--}}
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
                <span class="nav-item">

                  <a  class="button is-info is-small" href="{{ route( 'admin.dashboard.index' ) }}">Admin</a>

                </span>
            @endif

        </div>

    </div>

</nav>
