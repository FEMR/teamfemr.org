
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

    <div class="columns">

        <div class="column is-half">

            <div class="notification ">

                {!! Form::model( $program, [ 'method' => 'put', 'route' => [ 'admin.programs.update', $school->id, $program->id ] ]) !!}

                    @include( 'admin.programs.partials.form.base-fields' )

                    @include( 'admin.programs.partials.form.other-fields' )

                    <div class="field is-grouped">
                        <p class="control">
                            <button class="button is-primary">Submit</button>
                        </p>
                    </div>

                {!! Form::close() !!}

            </div>

        </div>

        <div class="column is-half">

            {{-- Only show the additional fields when there is an existing program --}}
            @if( isset( $program ) )

                @include( 'admin.programs.partials.form.locations.table' )

                @include( 'admin.programs.partials.form.contacts.table' )

                @include( 'admin.programs.partials.form.papers.table' )

                @include( 'admin.programs.partials.form.partners.table' )

            @endif

        </div>

    </div>

@endsection