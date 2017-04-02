<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <title>Team fEMR</title>

        @stack('styles-before')
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @stack('styles-after')

    </head>

    <body>

        @include( 'partials.header' )

        @yield( 'hero' )

        @yield('above-content')

        <div class="section">
            <div class="container">
                <div class="content">

                    @yield('content')

                </div>
            </div>
        </div>

        @yield('below-content')

        @include( 'partials.footer' )

        @stack('scripts-before')
        <script src="{{ mix('js/app.js') }}"></script>
        @stack('scripts-after')

    </body>
</html>