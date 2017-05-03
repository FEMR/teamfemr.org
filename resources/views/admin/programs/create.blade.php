
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Outreach Programs
    </h1>
    <h2 class="subtitle">Create</h2>

@endsection

@section( 'section-menu' )

    @include( 'admin.programs.partials.menu' )

@endsection

@section('section-content')

    <div class="columns">

        <div class="column is-half-tablet">
        {!! Form::open([ 'route' => [ 'admin.programs.store', $school->id ] ]) !!}

            @include( 'admin.programs.partials.form' )

        {!! Form::close() !!}
        </div>

    </div>

@endsection