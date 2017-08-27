
@extends ('layouts.admin')

@section( 'section-header' )

    <h1 class="title">
        Admin Dashboard
    </h1>
    <h2 class="subtitle">

    </h2>

@endsection


@section('section-content')

    <a href="{{ route( 'admin.programs.index' ) }}" class="button is-primary">Outreach Programs</a>

@endsection