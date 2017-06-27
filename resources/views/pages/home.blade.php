@extends ('layouts.app')

@section( 'hero' )
    <section class="hero is-dark has-text-centered home-hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-spaced">
                    Team fEMR
                </h1>
                <p>
                    We created a fast, open-source EMR for transient medical teams to promote data driven communication in low resource settings.
                </p>

                @include( 'components.donate.paypal' )

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

    @include( 'sections.demo' )

    @include( 'sections.news' )

@endsection