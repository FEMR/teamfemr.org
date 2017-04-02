<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Team fEMR Dashboard</title>

        @stack('styles-before')
        <link href="{{ mix('css/admin/admin.css') }}" rel="stylesheet">
        @stack('styles-after')

    </head>
<body>

    <nav class="nav has-shadow" id="top">
        <div class="container">
            <div class="nav-left">
                <a class="nav-item" href="{{ route( 'pages.home' ) }}">
                    <img src="{{ asset('images/logo/logo_color_med.png') }}" alt="Description">
                </a>
            </div>
            <span class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <div class="nav-right nav-menu is-hidden-tablet">
                <a href="{{ route( 'admin.dashboard.index' ) }}" class="nav-item {{ Route::currentRouteName() == 'admin.dashboard.index' ? 'is-active' : '' }}">
                    Dashboard
                </a>
                <a href="#" class="nav-item">
                    Locations
                </a>
                <a href="#" class="nav-item">
                    Teams
                </a>
                <a href="#" class="nav-item">
                    Pages
                </a>

                @if (Auth::check())
                    <span class="nav-item">Welcome {{ Auth::user()->name }}</span>
                    <a href="{{ url('/logout') }}" class="nav-item"><i class="fa fa-sign-out"></i>Logout</a>
                @else
                    <a href="{{ url('/login') }}" class="nav-item">Login</a>
                    <a href="{{ url('/register') }}" class="nav-item">Register</a>
                @endif

            </div>
        </div>
    </nav>

    <div class="columns">

        <aside class="column is-2 aside hero is-fullheight is-hidden-mobile">
            <div>
                <div class="main">
                    <a href="#" class="item {{ Route::currentRouteName() == 'admin.dashboard.index' ? 'is-active' : '' }}">
                        <span class="icon">
                            <i class="fa fa-home"></i>
                        </span>
                        <span class="name">Dashboard</span>
                    </a>
                    <a href="#" class="item">
                        <span class="icon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <span class="name">Locations</span>
                    </a>
                </div>
            </div>
        </aside>
        <div class="column is-10 admin-panel">

            @yield( 'above-content' )

            <section class="section">
                <div class="container">

                    @yield( 'content' )

                </div>
            </section>


            @yield( 'below-content' )

        </div>

    </div>

    <footer class="footer">
        <div class="container">
            <div class="has-text-centered">
                <p>
                    &copy {{ date( 'Y' ) }} Team fEMR
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts-before')
    <script src="{{ mix('js/admin/admin.js') }}"></script>
    @stack('scripts-after')

</body>
</html>