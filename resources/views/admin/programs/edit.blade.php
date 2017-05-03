
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Outreach Programs
    </h1>
    <h2 class="subtitle">Edit</h2>

@endsection

@section( 'section-menu' )

    @include( 'admin.programs.partials.menu' )

@endsection

@section('section-content')


    <div class="column is-half-tablet form-column">
        {!! Form::model( $program, [ 'method' => 'put', 'route' => [ 'admin.programs.update', $school->id, $program->id ] ]) !!}

            @include( 'admin.programs.partials.form' )

        {!! Form::close() !!}
    </div>

@endsection