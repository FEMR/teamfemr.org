
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Outreach Programs
    </h1>
    <h2 class="subtitle">All</h2>

@endsection

@section( 'section-menu' )

    @include( 'admin.programs.partials.menu' )

@endsection

@section('section-content')

    @if( $school->programs->count() > 0 )

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Year Initiated</th>
                    <th>Participants</th>
                    <th>Matriculants per class</th>
                    <th>Uses EMR</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach( $school->programs as $program )
                <tr>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->year_initiated }}</td>
                    <td>{{ $program->yearly_outreach_participants }}</td>
                    <td>{{ $program->matriculants_per_class }}</td>
                    <td>{{ ( $program->uses_emr ) ? 'Yes' : 'No' }}</td>
                    <td>
                        <nav class="level">
                            <div class="level-left"></div>
                            <div class="level-right">
                                <p class="level-item">
                                    <a class="button is-white" href="{{ route( 'admin.programs.edit', [ $school->id, $program->id ] ) }}">
                                        <span class="icon"><i class="fa fa-pencil-square-o"></i></span>
                                    </a>
                                </p>
                                {!! Form::open([ 'method' => 'delete', 'route' => [ 'admin.programs.destroy', $school->id, $program->id ], 'class' => 'level-item' ]) !!}
                                <button type="submit" class="button is-white">
                                    <span class="icon"><i class="fa fa-trash"></i></span>
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </nav>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    @else

        <p>There are no programs, but you can <a href="{{ route( 'admin.programs.create', [ $school->id ] ) }}">add one</a> now.</p>

    @endif

@endsection