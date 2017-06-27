<nav class="nav main-nav">

    <div class="container">

        <div class="nav-left">

            <a href="/" class="nav-item logo">
                <img src="{{ asset('images/logo/logo_no_tagline.png') }}" alt="Team fEMR Logo">
            </a>

            <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
            <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
            <span class="nav-item">
                <span class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </span>

        </div>

        <div class="nav-right nav-menu">

            <a href="/" class="nav-item">
                Home
            </a>

            <a href="#about" v-scroll-to="'#about'" class="nav-item">
                About
            </a>

            <a href="#open-source" v-scroll-to="'#open-source'" class="nav-item">
                Open Source
            </a>

            <a href="#news" v-scroll-to="'#news'"  class="nav-item">
                News
            </a>

            <a class="nav-item is-hidden-tablet" href="http://demo.teamfemr.org"target="_blank">
                fEMR Demo
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