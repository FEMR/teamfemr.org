
@extends ('layouts.admin')

@section( 'section-header' )

    <div class="header">

        <h1 class="title">Schools</h1>

    </div>

    <div class="level breadcrumbs is-mobile">
        <div class="level-left">

            <a class="level-item"href="{{ route( 'admin.dashboard.index' ) }}">Dashboard</a>
            <span class="level-item separator">&gt</span>
            <a class="level-item" href="{{ route( 'admin.schools.index' ) }}">Schools</a>
            <span class="level-item separator">&gt</span>
            <span class="level-item">Archived</span>

        </div>
    </div>

@endsection

@section( 'section-menu' )

    @include( 'admin.schools.partials.tabs' )

@endsection

@section('section-content')

    @if( $schools->count() > 0 )

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Postal Code</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $schools as $school )
                <tr>
                    <td>
                        {!! Form::open([ 'method' => 'post', 'route' => [ 'admin.schools.restore', $school->id ] ]) !!}
                        <button type="submit" class="button is-small" title="Restore">
                            <span class="icon is-small"><i class="fa fa-undo"></i></span>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $school->name }}</td>
                    <td>{!! $school->address !!}</td>
                    <td>{!! $school->locality !!}</td>
                    <td>{!! $school->administrative_area_level_1 !!}</td>
                    <td>{!! $school->postal_code !!}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    @else

        <p>There are no archived schools</p>

    @endif

@endsection