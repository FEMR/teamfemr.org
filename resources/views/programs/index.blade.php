@extends( 'layouts.app', [ 'content_wrapper_class' => 'has-top-spacing' ] )

@section( 'content' )
    <div class="outreach-program">

        <section class="section">
            <div class="container">

                <h1 class="title">International Medical Outreach Programs</h1>

                <hr />

                <div class="content">

                    <h3>University Programs</h3>

                    <div class="pagination-top">
                        <p class="pull-right">Page {{ $programs->currentPage() }} of {{  $programs->lastPage() }}</p>
                    </div>
                    <table class="table is-bordered">
                        <thead>
                            <tr>
                                @if( ! is_null( $user ) && $user->is_admin )
                                <th></th>
                                @endif
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
                                @if( ! is_null( $user ) && $user->is_admin )
                                <td>
                                    @if( $program->is_approved )
                                        <span class="icon is-medium">
                                          <i class="fa fa-lg fa-eye"></i>
                                        </span>
                                    @else
                                        <span class="icon is-medium">
                                          <i class="fa fa-lg fa-eye-slash has-text-danger"></i>
                                        </span>
                                    @endif
                                </td>
                                @endif
                                <td>
                                    <a href="{{ route( 'programs.show', [ $program->slug ] ) }}">
                                        {!! str_ireplace( '-', '- <br />', $program->name ) !!}
                                    </a>
                                </td>
                                <td class="tablet-only">{{ $program->months_of_travel_string }}</td>
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

                                    @if( ! is_null( $user ) && $user->can( 'update-survey', $program ) )
                                    <a href="{{ route( 'survey.edit', [ $program->id ] ) }}" class="button is-success is-small edit-survey">
                                        <span>Edit</span>
                                    </a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                    {{ $programs->links( 'vendor.pagination.bulma' ) }}

                </div>

            </div>
        </section>

        <section class="section take-survey-section">

            <div class="container">

                <div class="content">

                    <div class="columns">

                        <div class="column">

                            <h2 class="title">Want to list your program here?</h2>
                            <p>To add your program to this directory, please <a href="{{ route( 'survey.create' ) }}">fill out our survey</a>!</p>

                        </div>

                        <div class="column button-column">

                            <a class="button femr-button" href="{{ route( 'survey.create' ) }}">Take our quick survey (?)</a>

                        </div>

                    </div>


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