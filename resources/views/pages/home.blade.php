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

                @include( 'components.donate.paypal' )

                <slack-modal></slack-modal>

            </div>
        </div>
    </section>
@endsection


@section('above-content')
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