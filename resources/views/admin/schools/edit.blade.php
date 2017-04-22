
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Schools
    </h1>
    <h2 class="subtitle">Edit</h2>

@endsection

@section( 'section-menu' )

    @include( 'admin.schools.partials.menu' )

@endsection

@section('section-content')


    <div class="column is-half-tablet form-column">
        {!! Form::model($school, [ 'route' => 'admin.schools.store' ]) !!}

            @include( 'admin.schools.partials.form' )

        {!! Form::close() !!}
    </div>

@endsection