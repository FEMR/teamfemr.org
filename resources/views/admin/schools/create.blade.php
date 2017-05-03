
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Schools
    </h1>
    <h2 class="subtitle">Create</h2>

@endsection

@section( 'section-menu' )

    @include( 'admin.schools.partials.menu' )

@endsection

@section('section-content')

    <div id="map-form" class="columns school-form-columns">

        <div class="column is-half-tablet map-column">

            <femr-map></femr-map>

        </div>
        <div class="column is-half-tablet form-column">
        {!! Form::open([ 'route' => 'admin.schools.store' ]) !!}

            <school-form></school-form>

        {!! Form::close() !!}
        </div>
    </div>

@endsection