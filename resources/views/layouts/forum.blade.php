<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

        <title>Team fEMR</title>

        <link href="{{ mix('css/front/app.css') }}" rel="stylesheet">
        @yield('css')

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


        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

        @yield('js')

    </body>
</html>