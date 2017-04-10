@extends ('layouts.app')

@section( 'hero' )
    <section class="hero is-dark has-text-centered">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    A fast EMR solution for transient medical teams.
                </h1>
                <h2 class="subtitle">
                    We are using open source technology to promote data driven communciation in low resource settings.
                </h2>
            </div>
        </div>
    </section>
@endsection


@section('above-content')
    <div id="map"></div>
@endsection


@section('content')
    <div class="tile is-ancestor">
        <div class="tile is-vertical is-6">
            <div class="tile is-parent is-vertical">
                <article class="tile is-child box">
                    <p class="title">Team fEMR!</p>
                    <div class="content">
                        <p>We are students, doctors, and engineers. More importantly we are volunteers helping to provide the best healthcare possible to people who are often without access to life's basic necessities.</p>
                        <p><a href="./other/Annual_Report_2014_2015.pdf" class="button">First Annual Report</a></p>
                        <img src="{{ asset('/images/screenshots/team_femr.png') }}" alt="Team fEMR">
                    </div>
                </article>
                <article class="tile is-child box">
                    <p class="title">Who is fEMR for?</p>
                    <div class="content">
                        <p>We have designed fEMR for transient medical teams who need a fast and easy way to record patient information. Most of our users work in settings with limited infrastructure.</p>
                        <img src="/images/screenshots/who_is_femr_for.png" alt="Who is fEMR for">
                    </div>
                </article>
            </div>
        </div>
        <div class="tile is-parent is-vertical">
            <article class="tile is-child box">
                <p class="title">Open Source</p>
                <div class="content">
                    <p>fEMR is both free and open source. As a responsive web application, it can be used on any smart device.</p>
                    <ul>
                        <li>
                            <a href="https://github.com/femr/femr" target="_blank">
                                    <span class="icon">
                                        <i class="fa fa-github"></i>
                                    </span>
                                Repository
                            </a>
                        </li>
                        <li>
                            <a href="https://groups.google.com/forum/?utm_medium=email&utm_source=footer#!forum/team-femr" target="_blank" class="devButton" id="home_repoBtn">Mailing List</a>
                        </li>
                        <li>
                            <a href="https://teamfemr.atlassian.net" target="_blank" class="devButton" id="jiraButton">
                                Backlog</a>
                        </li>
                        <li>
                            <a href="{{ route( 'pages.slack' ) }}" target="_blank" class="devButton" id="slackButton">
                                <span class="icon">
                                    <i class="fa fa-slack"></i>
                                </span>
                                Slack
                            </a>
                            - Join the fEMR discussion in our slack chat!
                        </li>
                    </ul>
                </div>
            </article>
            <article class="tile is-child box">
                <div class="content">
                    <p class="title">Demo</p>
                    <p class="subtitle">Try out fEMR</p>
                    <div class="content">
                        <p>Check out our <a href="http://femr.teamfemr.org">development version of fEMR available for testing</a></p>
                        <ul>
                            <li><span id="username">Username: visitor</span></li>
                            <li><span id="password">Password: femr1</span></li>
                        </ul>
                        <img src="/images/screenshots/demo.png" alt="fEMR Demo Screenshot">
                    </div>
                </div>
            </article>
        </div>
    </div>
@endsection


@push( 'scripts-after' )
    <script>

        var bound;
        var map;

        function initMap(){

            bounds = new google.maps.LatLngBounds();

            map = new google.maps.Map( document.getElementById('map'), {
                center: { lat: 0.0, lng: 0.0 },
                zoom: 2,
                scrollwheel: false
//                    minZoom: 19
            });
        }

        var addMarkers = function( place ){

            if( typeof place == "undefined" ) return;

            console.log( place );

            var location = place.geometry.location;
            markers.push(
                    new google.maps.Marker({
                        position: location,
                        map: map
                    })
            );

            bounds.extend(location);

            if( markers.length >  1 ) {

                map.fitBounds(bounds);
            }
        };

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env( 'GMAPS_API_KEY' ) }}&libraries=places&callback=initMap"
            async defer></script>
@endpush
