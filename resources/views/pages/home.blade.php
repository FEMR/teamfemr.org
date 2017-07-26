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
                                <span>Demo</span>
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
            <gmap-cluster :grid-size="40">

                {{--<gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" :content="infoContent" @closeclick="infoWinOpen=false">--}}
                {{--</gmap-info-window>--}}

                <gmap-marker
                        :key="index"
                        v-for="(m, index) in locations"
                        :position="{ lat: m.latitude, lng: m.longitude }"
                        :clickable="true"
                        :draggable="false"
                        {{--@click="toggleInfoWindow(m,index)"--}}
                        {{--@click="center={ lat: m.latitude, lng: m.longitude }"--}}
                >

                        {{--<gmap-info-window>--}}
                            {{--<div class="map-info-window">--}}
                                {{--<p>@{{ m.outreach_program.name }}</p>--}}
                                {{--<p v-if="m.outreach_program.school"><strong>School:</strong> @{{ m.outreach_program.school.name }}</p>--}}
                                {{--<p>--}}
                                    {{--<strong>Location: </strong>--}}
                                    {{--<span class="city" v-if="m.administrative_area_level_1">@{{ m.administrative_area_level_1 }}</span>--}}
                                    {{--<span class="sep" v-if="m.administrative_area_level_1 && m.country">,</span>--}}
                                    {{--<span class="country" v-if="m.country">@{{ m.country }}</span>--}}
                                {{--</p>--}}
                                {{--<p>--}}
                                    {{--<a--}}
                                        {{--class="button femr-button"--}}
                                        {{--:href="'/programs/' + m.outreach_program.slug"--}}
                                        {{--target="_blank"--}}
                                        {{--style="margin: 10px auto; font-size: 0.8rem;"--}}
                                    {{-->--}}
                                        {{--More Info &raquo;--}}
                                    {{--</a>--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</gmap-info-window>--}}

                </gmap-marker>
            </gmap-cluster>
        </gmap-map>
    </div>
@endsection


@section('content')

    @include( 'sections.about' )

    @include( 'sections.open-source' )

    @include( 'sections.publications' )

    @include( 'sections.news' )

@endsection