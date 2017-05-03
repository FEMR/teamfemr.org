
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Outreach Programs
    </h1>
    <h2 class="subtitle">Archived</h2>

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
                                {!! Form::open([ 'method' => 'post', 'route' => [ 'admin.programs.restore', $school->id, $program->id ], 'class' => 'level-item' ]) !!}
                                    <button type="submit" class="button is-white" title="restore">
                                        <span class="icon"><i class="fa fa-undo"></i></span>
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

        <p>There are no archived programs</p>

    @endif

@endsection