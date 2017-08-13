@extends( 'layouts.app' )

@section( 'content' )
    <div class="outreach-program">
        <div class="container">

            <section class="section">
                <div class="container">
                    <h1 class="title">{{ $program->name }}</h1>

                    @if( $program->school )
                    <h2 class="subtitle">
                        {{ $program->school->name }}
                    </h2>
                    @endif

                    <hr />

                    <div class="content">

                        <div class="columns">

                            <div class="column">

                                <p class="stat emr"><strong>Uses EMR:</strong> {{ $program->uses_emr ? 'Yes' : 'No' }}</p>
                                <p class="stat initiated"><strong>Year Initiated:</strong> {{ $program->year_initiated ? $program->year_initiated : '' }}</p>
                                <p class="stat yearly_participants"><strong>Total Yearly Outreach Participants:</strong> {{ $program->yearly_outreach_participants ? $program->yearly_outreach_participants : '' }}</p>
                                <p class="stat matriculants"><strong>Matriculants per class:</strong> {{ $program->matriculants_per_class ? $program->matriculants_per_class : '' }}</p>

                                <p class="stat classes"><strong>Medical School Involvement:</strong> {{ $program->schoolClasses->pluck( 'name' )->implode( ', ' ) }}</p>

                                <div class="other-fields">
                                    @foreach( \FEMR\Data\Models\OutreachProgram::$default_fields as $key => $title )

                                        <p class="field-title"><strong>{{ $title }}</strong></p>
                                        <p>
                                            {{ isset( $program ) ? $program->getAdditionalFieldValue( $key ) : null }}
                                        </p>

                                    @endforeach
                                </div>

                            </div>

                            <div class="column">


                                <div class="visited-locations">

                                    <h3>Visited Locations</h3>

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

                                        <program-map program-id="{{ $program->id }}"></program-map>

                                </div>

                            </div>

                        </div>

                        <div class="columns">

                            <div class="column">

                                <div class="papers">

                                    <h4>Papers</h4>
                                    <table class="table is-bordered">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th></th>
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
                                                <td>
                                                    <a href="{{ $paper->url }}">
                                                        <span class="icon is-small">
                                                          <i class="fa fa-download"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="column">

                                <div class="contacts">

                                    <h4>Contacts</h4>

                                    <table class="table is-bordered">
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
                                                    Sign-in in to view
                                                    {{--{{ $paper->email }}--}}
                                                </td>
                                                <td>
                                                    Sign-in in to view
                                                    {{--{{ $paper->phone }}--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="column">

                                <div class="partners">

                                    <h4>Partner Organizations</h4>

                                    <table class="table is-bordered">
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

                </div>
            </section>


        </div>
    </div>

@endsection