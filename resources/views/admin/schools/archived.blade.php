
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Schools
    </h1>
    <h2 class="subtitle">Archived</h2>

@endsection

@section( 'section-menu' )

    @include( 'admin.schools.partials.menu' )

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