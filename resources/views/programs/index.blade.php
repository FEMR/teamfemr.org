@extends( 'layouts.app', [ 'content_wrapper_class' => 'has-top-spacing' ] )

@section( 'content' )
    <div class="outreach-program">

        <section class="section">
            <div class="container">

                <h1 class="title">International Medical Outreach Programs</h1>

                <hr />

                <div class="content">

                    <h3>University Programs</h3>
                    <table class="table is-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="tablet-only">Months of Travel</th>
                                <th class="tablet-only">Class Involvement</th>
                                <th class="tablet-only">Visited Locations</th>
                                <th class="tablet-only">Partners</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $programs as $program )
                            <tr>
                                <td>
                                    <a href="{{ route( 'programs.show', [ $program->slug ] ) }}">
                                        {!! str_ireplace( '-', '- <br />', $program->name ) !!}
                                    </a>
                                </td>
                                <td class="tablet-only">{{ $program->months_of_travel }}</td>
                                <td class="tablet-only">{{ $program->schoolClasses->pluck( 'name' )->implode( ', ' ) }}</td>
                                <td class="tablet-only">

                                    @if( $program->visitedLocations->count() )
                                    <div class="dropdown is-hoverable">
                                        <div class="dropdown-trigger">
                                            <a class="" aria-haspopup="true" aria-controls="dropdown-menu4">
                                                <span>{{ $program->visitedLocations->count() }}</span>
                                                <span class="icon is-small">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                            <div class="dropdown-content">
                                                <div class="dropdown-item">
                                                    <p class="countries"><strong>Countries</strong>: {{ $program->visitedLocations->pluck( 'country' )->unique()->implode( ', ' ) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td class="tablet-only">

                                    @if( $program->partnerOrganizations->count() )
                                        <div class="dropdown is-hoverable">
                                            <div class="dropdown-trigger">
                                                <a class="" aria-haspopup="true" aria-controls="dropdown-menu4">
                                                    <span>{{ $program->partnerOrganizations->count() }}</span>
                                                    <span class="icon is-small">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </span>
                                                </a>
                                            </div>
                                            <div class="dropdown-menu partners" id="dropdown-menu4" role="menu">
                                                <div class="dropdown-content">
                                                    <div class="dropdown-item">
                                                        <ul>
                                                            @foreach( $program->partnerOrganizations as $partner )
                                                                <li>{{ $partner->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route( 'programs.show', [ $program->slug ] ) }}" class="button is-info is-small">
                                        Full Survey
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>

            </div>
        </section>

    </div>

@endsection

@section('below-content')
    <div id="map">
        <femr-map></femr-map>
    </div>
@endsection