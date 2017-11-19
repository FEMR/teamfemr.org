<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>Team fEMR</title>

        @stack('styles-before')
        <link href="{{ mix('css/front/app.css') }}" rel="stylesheet">
        @stack('styles-after')

    </head>

    <body>

        <div id="app">

            @include( 'partials.header' )

            <div class="stretch-content {{ isset( $content_wrapper_class ) ? $content_wrapper_class : '' }}">

                @yield('above-content')

                @yield('content')

                @yield('below-content')

            </div>

            @include( 'partials.footer' )
        </div>

        <script>

            window.FEMR = {!! json_encode([

                'userToken' => user_token(),
                'csrfToken' => csrf_token(),
                'googleMapsKey' => env( 'GMAPS_API_KEY' )

            ]) !!};

        </script>
        @stack('scripts-before')
        <script src="{{ mix('js/front/app.js') }}"></script>
        @stack('scripts-after')

    </body>
</html>