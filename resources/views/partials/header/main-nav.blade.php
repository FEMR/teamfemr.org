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

            {{--@if( Route::currentRouteName() == 'pages.home' )--}}
            {{--<a href="#top-bar" v-scroll-to="'#top-bar'" class="nav-item">--}}
            {{--@else--}}
            {{--<a href="/" class="nav-item">--}}
            {{--@endif--}}
                {{--Home--}}
            {{--</a>--}}


            <a
                href="/#about"
                @if( Route::currentRouteName() == 'pages.home' )
                v-scroll-to="'#about'"
                @endif
                class="nav-item"
            >
                About
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
                Publications
            </a>

            <a
                href="/#news"
                @if( Route::currentRouteName() == 'pages.home' )
                v-scroll-to="'#news'"
                @endif
                class="nav-item"
            >
                News
            </a>

            <a
                    href="{{ route( 'programs.index' ) }}"
                    class="nav-item"
            >
                Surveys
            </a>

            <a class="nav-item is-hidden-tablet" href="{{ asset('/documents/Annual_Report_2014_2015.pdf') }}" target="_blank">
                Annual Report
            </a>

            <span class="nav-item">

                @include( 'components.donate.paypal' )

            </span>

        </div>

    </div>

</nav>