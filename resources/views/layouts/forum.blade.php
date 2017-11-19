<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>Team fEMR</title>

        <link href="{{ mix('css/front/app.css') }}" rel="stylesheet">
        @yield('css')
        <link href="{{ mix('css/front/forum.css') }}" rel="stylesheet">

    </head>

    <body>

        <div id="app">

            @include( 'partials.header' )

            <div class="stretch-content {{ isset( $content_wrapper_class ) ? $content_wrapper_class : '' }}">

                @yield( 'hero' )

                @yield('above-content')

                @yield('content')

                @yield('below-content')

            </div>

            @include( 'partials.footer' )
        </div>


        <script src="{{ mix('js/front/forum.js') }}"></script>
        @yield('js')

    </body>
</html>