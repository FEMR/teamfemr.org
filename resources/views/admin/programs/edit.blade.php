
@extends ('layouts.admin')

@section( 'section-header' )

    <div class="header">
        <h1 class="title">Outreach Programs</h1>
    </div>

    <div class="level breadcrumbs is-mobile">
        <div class="level-left">

            <a class="level-item"href="{{ route( 'admin.dashboard.index' ) }}">Dashboard</a>
            <span class="level-item separator">&gt</span>
            <a class="level-item" href="{{ route( 'admin.schools.index' ) }}">Schools</a>
            <span class="level-item separator">&gt</span>
            <a class="level-item" href="{{ route( 'admin.schools.edit', [ $school->id ] ) }}">{{ $school->name }}</a>
            <span class="level-item separator">&gt</span>
            <a class="level-item" href="{{ route( 'admin.programs.index', [ $school->id ] ) }}">Outreach Programs</a>
            <span class="level-item separator">&gt</span>
            <span class="level-item">Edit</span>

        </div>
    </div>

@endsection

@section( 'section-menu' )

    @include( 'admin.programs.partials.tabs' )

@endsection

@section('section-content')


    <div class="column is-half-tablet">
        {!! Form::model( $program, [ 'method' => 'put', 'route' => [ 'admin.programs.update', $school->id, $program->id ] ]) !!}

            <div class="notification">
                @include( 'admin.programs.partials.form' )
            </div>

        {!! Form::close() !!}
    </div>

@endsection