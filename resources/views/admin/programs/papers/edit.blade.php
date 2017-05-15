
@extends ('layouts.admin')

@section( 'section-header' )

    <div class="header">
        <h1 class="title">Papers</h1>
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
            <a class="level-item" href="{{ route( 'admin.programs.edit', [ $school->id, $program->id ] ) }}">{{ $program->name }}</a>
            <span class="level-item separator">&gt</span>
            <a class="level-item" href="{{ route( 'admin.papers.index', [ $school->id, $program->id ] ) }}">Papers</a>
            <span class="level-item separator">&gt</span>
            <span class="level-item">Edit</span>

        </div>
    </div>

@endsection

@section( 'section-menu' )

    @include( 'admin.programs.papers.partials.tabs' )

@endsection

@section('section-content')

    {!! Form::model( $paper, [ 'method' => 'put', 'route' => [ 'admin.papers.update', $school->id, $program->id, $paper->id ] ]) !!}

        @include( 'admin.programs.papers.partials.form' )

    {!! Form::close() !!}

@endsection