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

    <div id="app">
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
                <div class="nav-right nav-menu">

                    <span class="nav-item">
                        {!! Form::open([ 'method' => 'POST', 'route' => 'logout' ]) !!}
                        <button class="button" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</button>
                        {!! Form::close() !!}
                    </span>

                </div>
            </div>
        </nav>

        <div class="columns admin-panel">
            <aside class="column is-2 aside hero is-fullheight is-hidden-mobile">
                <div class="main">
                    <aside class="menu is-dark">

                        @include( 'admin.partials.side-nav' )

                    </aside>
                </div>
            </aside>
            <div class="column is-10 admin-content">

                {{-- Header Section --}}
                <section class="hero">
                    <div class="hero-body">
                        <div class="wrapper">

                            @yield( 'section-header' )

                        </div>
                    </div>
                </section>

                {{-- Section Menu --}}
                <section class="section section-menu">
                    <div class="wrapper">

                        @yield( 'section-menu' )

                    </div>
                </section>

                {{-- Main Content --}}
                <section class="section main-content">
                    <div class="wrapper">

                        @include( 'admin.partials.errors-list' )

                        @yield( 'section-content' )

                    </div>
                </section>

            </div>
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

    <script>

        var FEMR = {!! json_encode([
            'csrfToken' => csrf_token(),
            'googleMapsKey' => env( 'GMAPS_API_KEY' )
        ]) !!};

    </script>
    @stack('scripts-before')
    <script src="{{ mix('js/admin/admin.js') }}"></script>
    @stack('scripts-after')

</body>
</html>