@extends( 'layouts.app', [ 'content_wrapper_class' => 'has-top-spacing' ] )

@section( 'content' )
    <div class="outreach-program">

        <section class="section">
            <div class="container">

                <p class="back-button"><a class="button is-link" href="{{ route( 'programs.index' ) }}">&laquo; All Surveyed Programs</a></p>

                @if( ! is_null( $user ) && $user->can( 'update-survey', $program ) )
                <a href="{{ route( 'survey.edit', [ $program->id ] ) }}" class="button is-success is-small pull-right">
                    Edit
                </a>
                @endif

                <h1 class="title">{!! str_ireplace( '-', '- <br />', $program->name ) !!}</h1>

                <hr />

                <div class="content">

                    <div class="columns">

                        <div class="column is-5 map-column">


                            <div class="visited-locations">

                                <h4>Visited Locations ({{ $program->visitedLocations->count() }})</h4>

                                <p class="countries"><strong>Countries</strong>: {{ $program->visitedLocations->pluck( 'country' )->unique()->implode( ', ' ) }}</p>

                                <program-map program-id="{{ $program->id }}"></program-map>

                            </div>

                        </div>
                        <div class="column is-7 info-column">

                            <p class="stat months"><strong>Months of Travel:</strong> {{ $program->months_of_travel_string }}</p>
                            <p class="stat initiated"><strong>Year Initiated:</strong> {{ $program->year_initiated ? $program->year_initiated : '' }}</p>
                            <p class="stat yearly_participants"><strong>Total Yearly Outreach Participants:</strong> {{ $program->yearly_outreach_participants ? $program->yearly_outreach_participants : '' }}</p>
                            <p class="stat matriculants"><strong>Matriculants per class:</strong> {{ $program->matriculants_per_class ? $program->matriculants_per_class : '' }}</p>

                            <p class="stat classes"><strong>Medical School Involvement:</strong> {{ $program->schoolClasses->pluck( 'name' )->implode( ', ' ) }}</p>

                            <div class="other-fields">

                                @foreach( \FEMR\Data\Models\OutreachProgram::$default_fields as $key => $title )
                                <div class="field">

                                    <p class="field-title"><strong>{{ $title }}</strong></p>
                                    @if( $program->getAdditionalFieldValue( $key ) )
                                    <p>
                                        {!! nl2br( $program->getAdditionalFieldValue( $key ) ) !!}
                                    </p>
                                    @else
                                    <p>---</p>
                                    @endif

                                </div>
                                @endforeach
                            </div>

                        </div>


                    </div>

                    <div class="columns info-columns">


                        <div class="column">

                            <div class="papers">

                                <h4>Papers</h4>
                                    @if( $program->papers->count() )
                                    <ul>
                                        @foreach( $program->papers as $paper )
                                        <li>
                                            <a href="{{ $paper->url }}">
                                                {{ $paper->title }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    ---
                                    @endif

                            </div>

                        </div>


                        <div class="column">

                            <div class="contacts">

                                <h4>Contacts</h4>

                                @if( $program->contacts->count() )
                                <ul>
                                    @foreach( $program->contacts as $contact )
                                    <li>
                                        <span class="name">{{ $contact->first_name }} {{ $contact->last_name }}</span>

                                        @if( \Auth::check() )
                                        <span class="email">{{ $contact->email }}</span>
                                        <span class="phone">{{ $contact->phone }}</span>
                                        @else
                                        <span class="email">
                                            <a href="/login">Login for contact info</a>
                                        </span>
                                        @endif

                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                ---
                                @endif

                            </div>

                        </div>


                        <div class="column">

                            <div class="partners">

                                <h4>Partner Organizations</h4>

                                <ul>
                                @if( $program->partnerOrganizations->count() )

                                    @foreach( $program->partnerOrganizations as $partner )
                                        <li>
                                            <td>
                                                @if( ! empty( $partner->url ) )
                                                <a href="{{ $partner->url }}" target="_blank">
                                                @endif

                                                    {{ $partner->name }}

                                                @if( ! empty( $partner->url ) )
                                                </a>
                                                @endif

                                            </td>
                                        </li>
                                    @endforeach

                                @else
                                ---
                                @endif
                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>

    </div>

@endsection