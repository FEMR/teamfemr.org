@extends( 'layouts.app' )

@section( 'content' )
    <div class="outreach-program">

        <section class="section">
            <div class="container">

                <h1 class="title">Surveyed Outreach Programs</h1>

                <p>Add some text here that talks about how these programs were surveyed -- writing is not my strong suit</p>

                <div class="content">

                    <table class="table is-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Yearly Participants</th>
                                <th>Months of Travel</th>
                                <th>Visited Locations</th>
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
                                <td>{{ $program->yearly_outreach_participants }}</td>
                                <td>{{ $program->months_of_travel }}</td>
                                <td>

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
                                    @else
                                        0
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