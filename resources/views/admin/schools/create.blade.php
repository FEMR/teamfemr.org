
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
            <span class="level-item">Create</span>

        </div>
    </div>

@endsection

@section( 'section-menu' )

    @include( 'admin.schools.partials.tabs' )

@endsection

@section('section-content')

    <div class="columns">

        <div class="column is-half-tablet">
        {!! Form::open([ 'route' => 'admin.schools.store' ]) !!}

            <div class="notification">
                <school-form></school-form>
            </div>

        {!! Form::close() !!}
        </div>

        <div class="column is-half-tablet">
            <femr-map></femr-map>
        </div>

    </div>


@endsection