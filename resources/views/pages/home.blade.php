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
    <femr-map></femr-map>
@endsection


@section('content')

    @include( 'sections.about' )

    @include( 'sections.open-source' )

    @include( 'sections.publications' )

    @include( 'sections.news' )

@endsection