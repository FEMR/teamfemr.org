
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
            <span class="level-item">Edit</span>

        </div>
    </div>

@endsection

@section( 'section-menu' )

    @include( 'admin.schools.partials.tabs' )

@endsection

@section('section-content')


    <div class="column is-half-tablet">
        {!! Form::model( $school, [  'method' => 'put', 'route' => [ 'admin.schools.update', $school->id ] ]) !!}

            <div class="notification">
                @include( 'admin.schools.partials.form' )
            </div>

        {!! Form::close() !!}
    </div>

@endsection