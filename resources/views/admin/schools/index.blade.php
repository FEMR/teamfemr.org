
@extends ('layouts.admin')

@section( 'section-header' )

    <div class="header">

        <h1 class="title">Schools</h1>

    </div>

    <div class="level breadcrumbs is-mobile">
        <div class="level-left">

            <span class="level-item"><a href="{{ route( 'admin.dashboard.index' ) }}">Dashboard</a></span>
            <span class="level-item separator">&gt</span>
            <span class="level-item">Schools</span>

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
                        @include( 'admin.schools.partials.dropdown' )
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

        <p>There are no schools, but you can <a href="{{ route( 'admin.schools.create' ) }}">add one</a> now.</p>

    @endif

@endsection