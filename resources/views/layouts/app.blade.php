<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <title>Team fEMR</title>

        @stack('styles-before')
        <link href="{{ mix('css/front/app.css') }}" rel="stylesheet">
        @stack('styles-after')

    </head>

    <body>

        <div id="app">
            @include( 'partials.header' )

            @yield( 'hero' )

            @yield('above-content')

            @yield('content')

            @yield('below-content')

            @include( 'partials.footer' )
        </div>

        <script>

            var FEMR = {!! json_encode([

            'csrfToken' => csrf_token(),
            'googleMapsKey' => env( 'GMAPS_API_KEY' )

            ]) !!};

        </script>
        @stack('scripts-before')
        <script src="{{ mix('js/front/app.js') }}"></script>
        @stack('scripts-after')

    </body>
</html>