@extends ('layouts.app')

@section( 'hero' )
    <section class="hero is-dark has-text-centered">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    A fast EMR solution for transient medical teams.
                </h1>
                <h2 class="subtitle">
                    We are using open source technology to promote data driven communication in low resource settings.
                </h2>

                <a class="button is-success is-large">Donate</a>

            </div>
        </div>
    </section>
@endsection


@section('above-content')
    <a name="search"></a>
    <div class="map-container">
        <div class="search">
            <p>Search stuff will go here</p>
        </div>
        <gmap-map
                ref="gmap"
                :center="center"
                :zoom="zoom"
                :options="{ scrollwheel: false }"
                class="map">
            <gmap-marker
                    :key="index"
                    v-for="(m, index) in markers"
                    :position="m.position"
                    :clickable="true"
                    :draggable="true"
                    @click="center=m.position">
            </gmap-marker>
        </gmap-map>
    </div>
@endsection


@section('content')

    <section class="hero is-dark has-text-centered">
        <div class="hero-body">
            <div class="container">

                <a name="about-femr"></a>

                <h2 class="title">
                    Team fEMR!
                </h2>
                <p class="subtitle">
                    We are students, doctors, and engineers. More importantly we are volunteers<br />
                    helping to provide the best healthcare possible to people who are often without access to life's basic necessities.
                </p>

                {{--<p><a href="./other/Annual_Report_2014_2015.pdf" class="button">First Annual Report</a></p>--}}
                <img src="{{ asset('/images/screenshots/team_femr.png') }}" alt="Team fEMR">
            </div>
        </div>
    </section>

    <section class="hero has-text-centered">
        <div class="hero-body">
            <div class="container">
                <a name="who-femr"></a>
                <h2 class="title">
                    Who is fEMR for?
                </h2>
                <p class="subtitle">
                    We have designed fEMR for transient medical teams who need a fast and easy way to record patient information. Most of our users work in settings with limited infrastructure.
                </p>

                {{--<p><a href="./other/Annual_Report_2014_2015.pdf" class="button">First Annual Report</a></p>--}}
                <img src="{{ asset('/images/screenshots/who_is_femr_for.png') }}" alt="Team fEMR">
            </div>
        </div>
    </section>

    <section class="hero is-dark has-text-centered">
        <div class="hero-body">
            <div class="container">

                <a name="open-source"></a>

                <h2 class="title">
                    Open Source
                </h2>

                <div class="columns">
                    <div class="column is-two-thirds">

                        <div class="notification is-dark">

                            <p class="subtitle">
                                fEMR is both free and open source.
                            </p>
                            <p class="subtitle">
                                As a responsive web application, it can be used on any smart device.
                            </p>

                            <ul>
                                <li>
                                    <a href="https://github.com/femr/femr" target="_blank">
                                        GitHub Repository
                                    </a>
                                </li>
                                <li>
                                    <a href="https://groups.google.com/forum/?utm_medium=email&utm_source=footer#!forum/team-femr" target="_blank" class="devButton" id="home_repoBtn">Mailing List</a>
                                </li>
                                <li>
                                    <a href="https://teamfemr.atlassian.net" target="_blank" class="devButton" id="jiraButton">
                                        Backlog</a>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <div class="column">

                        <div class="notification is-dark">

                            <h3 class="title">
                                Join our Slack
                            </h3>

                            <p class="subtitle">Enter your email for an invite</p>
                            <p class="button is-info is-large">FORM WILL GO HERE</p>
                        </div>

                    </div>
                </div>

                {{--<img src="{{ asset('/images/screenshots/open_source.png') }}" alt="Team fEMR">--}}

            </div>
        </div>
    </section>

    <section class="hero has-text-centered">
        <div class="hero-body">
            <div class="container">

                <a name="demo-femr"></a>

                <h2 class="title">
                    Demo
                </h2>
                <p class="subtitle">
                    Check out our development version of fEMR available for testing
                </p>

                {{--<p><a href="./other/Annual_Report_2014_2015.pdf" class="button">First Annual Report</a></p>--}}
                <img src="{{ asset('/images/screenshots/demo.png') }}" alt="Team fEMR">

                <p>
                    <a href="http://demo.teamfemr.org" class="button is-info is-large" target="_blank">
                        <span>Try out fEMR</span>
                        <span class="icon">
                          <i class="fa fa-external-link"></i>
                        </span>
                    </a>
                </p>
                <ul>
                    <li><span id="username">Username: visitor</span></li>
                    <li><span id="password">Password: femr1</span></li>
                </ul>
            </div>
        </div>
    </section>


    <section class="hero is-dark">
        <div class="hero-body">
            <div class="container content">

                <a name="news"></a>

                <h2 class="title">
                    News
                </h2>


                <p><a class="button is-success" href="./public/other/Annual_Report_2014_2015.pdf">First Annual Report</a></p>

                <ul class="has-text-light">
                    <li>
                        <a href="http://www.youtube.com/watch?v=Zppwhc2vHgo">
                            Wayne State University promo campaign video featuring fEMR
                        </a>
                    </li>
                    <li>
                        <a href="http://www.improvewsu.org/Articles/tabid/90/ID/6/WSU-Students-Lead-Development-of-Electronic-Medical-Records-in-Haiti.aspx">
                            Wayne State University, ImproveWSU.org, "WSU students lead development of electronic medical records in Haiti"
                        </a>
                    </li>
                    <li>
                        <a href="http://www.emrandehr.com/tag/emergency-ehr/">
                            EMR & EHR Forum, Review by field expert, "fEMR targets pop-up clinics' needs"
                        </a>
                    </li>
                    <li>
                        <a href="http://www.clickondetroit.com/news/live-in-the-d/detroit-college-students-aim-to-help-haiti-earthquake-victims/24959282">
                            Live in the D, WDIV Detroit, news segment, "Detroit college students aim to help Haiti earthquake victims"
                        </a>
                    </li>
                    <li>
                        <a href="http://prognosis.med.wayne.edu/article/wsu-computer-science-students-open-source-software-benefits-med-school-mission-trips">
                            Wayne State University SOM Prognosis E-news, "WSU computer science students'     open source software benefits School of Medicine mission trips"
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

@endsection


{{--@push( 'scripts-after' )--}}
    {{--<script>--}}

        {{--var bound;--}}
        {{--var map;--}}

        {{--function initMap(){--}}

            {{--bounds = new google.maps.LatLngBounds();--}}

            {{--map = new google.maps.Map( document.getElementById('map'), {--}}
                {{--center: { lat: 0.0, lng: 0.0 },--}}
                {{--zoom: 2,--}}
                {{--scrollwheel: false--}}
{{--//                    minZoom: 19--}}
            {{--});--}}
        {{--}--}}

        {{--var addMarkers = function( place ){--}}

            {{--if( typeof place == "undefined" ) return;--}}

            {{--console.log( place );--}}

            {{--var location = place.geometry.location;--}}
            {{--markers.push(--}}
                    {{--new google.maps.Marker({--}}
                        {{--position: location,--}}
                        {{--map: map--}}
                    {{--})--}}
            {{--);--}}

            {{--bounds.extend(location);--}}

            {{--if( markers.length >  1 ) {--}}

                {{--map.fitBounds(bounds);--}}
            {{--}--}}
        {{--};--}}

    {{--</script>--}}
    {{--<script src="https://maps.googleapis.com/maps/api/js?key={{ env( 'GMAPS_API_KEY' ) }}&libraries=places&callback=initMap"--}}
            {{--async defer></script>--}}
{{--@endpush--}}
