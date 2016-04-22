<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Team fEMR</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    {{--<link href="/css/literatureBank.css" rel="stylesheet">--}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans">
    <script type="text/javascript" src="/js/main.js"></script>
</head>
<body>

<div class="top margins">

    <img src="  /images/Logo/logo_color_med.png" alt="Logo">

</div>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
           {{--Navigation Menu Bar--}}
            <ul class="nav navbar-nav centered-nav">
                <li><a href="{{ url('/home0') }}">Home</a></li>
                <li><a href="{{ url('/news') }}">News</a></li>
                <li><a href="{{ url('/emr') }}">EMR</a></li>
        {{--Trip Database Drop Down includes:(tripdatabase/literaturebank/disscussionboard/approvals)--}}

                <li class="dropdown"> {{--This li is the TRIP DATABASE WebPages--}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Team Resources <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">  {{--This puts everything under TRIP DATABASE--}}
                        <li><a href="{{ url('/tripdatabase') }}">Trip Database</a></li>
                        <li><a href="{{ url('/literaturebank') }}">Literature Bank</a></li>

                        @if (Auth::guest())


                        @elseif (Auth::user()->moderator())
                            <li><a href="{{ url('/forum') }}">Discussion Board</a></li>
                            <li class="divider"></li>
                            {{--<li class="dropdown-menu-right"> <a tabindex="-1" href="#">Approvals <span class="caret"></span></a>--}}
                                {{--<ul class="dropdown-menu">--}}
                                    <li><a tabindex="-1" href="{{ url('/approvals/edit') }}">Survey Approvals</a></li>
                                    <li><a href="{{ url('/approvals/lit_approvals') }}">Literature Approvals</a></li>
                                    <li><a href="{{ url('/approvals/mod_approvals') }}">Moderator Approvals</a></li>
                                {{--</ul>--}}
                            {{--</li>--}}

                        @else
                            <li><a href="{{ url('/forum') }}">Discussion Board</a></li>
                        @endif

                    </ul>

                </li> {{--ends the Trip Database WebPages--}}
                <li><a href="mailto:info@teamfemr.org">Contact</a></li>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>

                @elseif (Auth::user()->moderator())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif

            </ul>

        </div>

    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-30">
            <div class="panel panel-default">

                @yield('content')

            </div>
        </div>
    </div>
</div>

<footer>
    <hr >
    <div class="donateWrap margins">
        <div class="donatePayPalWrap">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
        <div class="donateBitcoinWrap">
            <a class="coinbase-button" data-code="b8522614ed49a6b66628863d6ff8d661" data-button-style="donation_small" href="https://www.coinbase.com/checkouts/b8522614ed49a6b66628863d6ff8d661">
                Donate Bitcoins</a>
            <script src="https://www.coinbase.com/assets/button.js" type="text/javascript"></script>
        </div>

    </div>
    <div class="margins">
        <p>&copy; 2015 - Team fEMR</p>
    </div>

</footer>

</body>
</html>