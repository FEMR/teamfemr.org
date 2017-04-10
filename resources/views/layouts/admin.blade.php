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
                <a class="nav-item" href="{{ route( 'admin.dashboard.index' ) }}">
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
                    Schools
                </a>
                <a href="#" class="nav-item">
                    Teams
                </a>
                <a href="#" class="nav-item">
                    Pages
                </a>
            </div>
        </div>
    </nav>

    <div class="columns admin-panel">
        <aside class="column is-2 aside hero is-fullheight is-hidden-mobile">
            <div class="main">
                <aside class="menu is-dark">
                    <p class="menu-label">
                        General
                    </p>
                    <ul class="menu-list">
                        <li>
                            <a href="{{ route( 'admin.dashboard.index' ) }}" class="item {{ Route::currentRouteName() == 'admin.dashboard.index' ? 'is-active' : '' }}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route( 'admin.dashboard.sandbox' ) }}" class="nav-item {{ Route::currentRouteName() == 'admin.dashboard.sandbox' ? 'is-active' : '' }}">
                                Sandbox
                            </a>
                        </li>
                        <li>
                            <a href="#" class="item">
                                Schools
                            </a>
                        </li>
                    </ul>
                    <p class="menu-label">
                        Administration
                    </p>
                    <ul class="menu-list">
                        <li><a>Team Settings</a></li>
                        <li>
                            <a>Manage Your Team</a>
                            <ul>
                                <li><a>Link 1</a></li>
                                <li><a>Link 2</a></li>
                                <li><a>Link 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>
        </aside>
        <div class="column is-10 admin-content">

            @yield( 'section-header' )

            @yield( 'section-content' )

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