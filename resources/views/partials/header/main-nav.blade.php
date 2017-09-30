<nav class="nav main-nav">

    <div class="container">

        <div class="nav-left">

            <a
                @if( Route::currentRouteName() == 'pages.home' )
                href="#top-bar"
                v-scroll-to="'#top-bar'"
                @else
                href="/"
                @endif

                class="nav-item logo"
            >
                <img src="{{ asset('images/logo/logo_no_tagline.png') }}" alt="Team fEMR Logo">
            </a>

            <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
            <!-- Toggle the "is-active" class on "nav-menu" -->
            <span class="nav-item">
                <span class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </span>

        </div>

        <div class="nav-right nav-menu">

            <a
                href="/"
                class="nav-item"
            >
                Home
            </a>

            <a
                href="/#open-source"
                @if( Route::currentRouteName() == 'pages.home' )
                v-scroll-to="'#open-source'"
                @endif
                class="nav-item"
            >
                Open Source
            </a>

            <a
                href="/#publications"
                @if( Route::currentRouteName() == 'pages.home' )
                v-scroll-to="'#publications'"
                @endif
                class="nav-item"
            >
                Publications<br >
            {{--</a>--}}

            {{--<a--}}
                {{--href="/#news"--}}
                {{--@if( Route::currentRouteName() == 'pages.home' )--}}
                {{--v-scroll-to="'#news'"--}}
                {{--@endif--}}
                {{--class="nav-item"--}}
            {{-->--}}
                and News
            </a>

            <a
                    href="{{ route( 'programs.index' ) }}"
                    class="nav-item"
            >
                International Med. <br > Outreach Programs
            </a>

            <a class="nav-item is-hidden-tablet" href="{{ asset('/documents/Annual_Report_2017.pdf') }}" target="_blank">
                2017 Annual Report
            </a>
            <a class="nav-item is-hidden-tablet" href="{{ asset('/documents/Annual_Report_2016.pdf') }}" target="_blank">
                2016 Annual Report
            </a>
            <a class="nav-item is-hidden-tablet" href="{{ asset('/documents/Annual_Report_2015.pdf') }}" target="_blank">
                2015 Annual Report
            </a>

            @if( Auth::check() )

                {{--@if( Auth::user()->is_admin )--}}
                {{--<span class="nav-item">--}}
                {{--<a  class="button is-info is-small" href="{{ route( 'admin.dashboard.index' ) }}">Admin</a>--}}
                {{--</span>--}}
                {{--@endif--}}

                <span class="nav-item is-hidden-tablet logged-in-status">
                    Welcome {{ Auth::user()->name }}
                    |
                    {!! Form::open([ 'method' => 'POST', 'route' => 'logout' ]) !!}
                    <button class="logout-button" href="{{ url('/logout') }}">Logout</button>
                    {!! Form::close() !!}
                </span>

            @else
                <a class="nav-item is-hidden-tablet" href="{{ route( 'register' ) }}">
                    Register
                </a>

                <a class="nav-item is-hidden-tablet" href="{{ route( 'login' ) }}">
                    Login
                </a>

            @endif

            <span class="nav-item">

                @include( 'components.donate.paypal' )

            </span>

        </div>

    </div>

</nav>