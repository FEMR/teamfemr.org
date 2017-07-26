@extends( 'layouts.app' )

@section( 'content' )
    <div class="outreach-program">
        <div class="container">

            <div class="content">
                <h1 class="title">{{ $program->name }}</h1>

                @if( $program->school )
                <p class="school"><strong>School:</strong> {{ $program->school->name }}</p>
                @endif

                <p class="emr"><strong>Uses EMR:</strong> {{ $program->uses_emr ? 'Yes' : 'No' }}</p>
                <p class="initiated"><strong>Year Initiated:</strong> {{ $program->year_initiated ? $program->year_initiated : '' }}</p>
                <p class="yearly_participants"><strong>Total Yearly Outreach Participants:</strong> {{ $program->yearly_outreach_participants ? $program->yearly_outreach_participants : '' }}</p>
                <p class="matriculants"><strong>Matriculants per class:</strong> {{ $program->matriculants_per_class ? $program->matriculants_per_class : '' }}</p>

                <p class="classes"><strong>Medical School Involvement:</strong> {{ $program->schoolClasses->pluck( 'name' )->implode( ', ' ) }}</p>

                <div class="other-fields">
                @foreach( \FEMR\Data\Models\OutreachProgram::$default_fields as $key => $title )

                    <p class="field-title"><strong>{{ $title }}</strong>: {{ isset( $program ) ? $program->getAdditionalFieldValue( $key ) : null }}
                        </p>

                @endforeach
                </div>

                <p>&nbsp;</p>

                <div class="notification visited-locations">

                    <h3>Visited Locations</h3>

                    <div class="columns">
                        <div class="column">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Dates</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $program->visitedLocations as $location )
                                    <tr>
                                        <td>
                                            @if( $location->administrative_area_level_1 )
                                                <span class="city">
                                            {{  $location->administrative_area_level_1 }}
                                        </span>
                                            @endif
                                            @if( $location->administrative_area_level_1 && $location->country )
                                                <span class="sep">,</span>
                                            @endif
                                            @if( $location->country )
                                                <span class="country">{{ $location->country }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $location->start_date )
                                                {{ $location->start_date->format( 'm/d/y' ) }}
                                            @endif
                                            @if( $location->start_date && $location->end_date )
                                                -
                                            @endif
                                            @if( $location->end_date )
                                                {{ $location->end_date->format( 'm/d/y' ) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="columns">

                            <div class="map">
                                MAP WILL GO HERE
                                {{--<gmap-map--}}
                                {{--ref="gmap"--}}
                                {{--:center="center"--}}
                                {{--:zoom="zoom"--}}
                                {{--:options="{ scrollwheel: false }"--}}
                                {{--class="map">--}}
                                {{--<gmap-cluster :grid-size="40">--}}

                                {{--<gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" :content="infoContent" @closeclick="infoWinOpen=false">--}}
                                {{--</gmap-info-window>--}}

                                {{--<gmap-marker--}}
                                {{--:key="index"--}}
                                {{--v-for="(m, index) in locations"--}}
                                {{--:position="{ lat: m.latitude, lng: m.longitude }"--}}
                                {{--:clickable="true"--}}
                                {{--:draggable="false"--}}
                                {{--></gmap-marker>--}}
                                {{----}}
                                {{--</gmap-cluster>--}}
                                {{--</gmap-map>--}}
                            </div>

                        </div>
                    </div>



                </div>

                <div class="notification papers">

                    <h3>Papers</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $program->papers as $paper )
                            <tr>
                                <td>
                                    <a href="{{ $paper->url }}">
                                        {{ $paper->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ $paper->description }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="notification contacts">

                    <h3>Contacts</h3>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $program->contacts as $contact )
                            <tr>
                                <td>
                                    {{ $contact->title }}
                                </td>
                                <td>
                                    {{ $contact->first_name }} {{ $contact->last_name }}
                                </td>
                                <td>
                                    {{ $paper->email }}
                                </td>
                                <td>
                                    {{ $paper->phone }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="notification partners">

                    <h3>Partner Organizations</h3>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Website</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $program->partnerOrganizations as $partner )
                            <tr>
                                <td>
                                    {{ $partner->name }}
                                </td>
                                <td>
                                    <a href="{{ $partner->url }}">
                                        {{ $paper->phone }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

@endsection