@extends ('layouts.app')

@section( 'hero' )
    <section class="hero is-dark has-text-centered home-hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-spaced">
                    Team fEMR
                </h1>
                <p>
                    We created a fast, open-source EMR for transient medical teams in order to promote data driven communication in low resource settings.
                </p>

                <div class="columns button-columns">

                    {{--<div class="column">--}}
                        {{--<div class="publications">--}}

                            {{--<a href="#publications" v-scroll-to="'#publications'"  class="button femr-button publications-button" >--}}
                                {{--<span>Publications</span>--}}
                            {{--</a>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="column">
                        <div class="demo">

                            <a href="http://demo.teamfemr.org" class="button femr-button demo-button" target="_blank">
                                <span>Try the demo</span>
                            </a>
                            <ul class="credentials">
                                <li><span id="username">username: visitor</span></li>
                                <li><span id="password">password: fEMR2016</span></li>
                            </ul>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection


@section('below-content')
    <a name="search"></a>
    <div class="map-container">
        {{--<div class="search">--}}
            {{--<p>Search stuff will go here</p>--}}
        {{--</div>--}}
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

    @include( 'sections.about' )

    @include( 'sections.open-source' )

    @include( 'sections.publications' )

    @include( 'sections.news' )

@endsection