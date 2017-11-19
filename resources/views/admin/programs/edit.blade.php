
@extends ('layouts.admin')

@section( 'section-header' )

    <div class="header">
        <h1 class="title">Outreach Programs</h1>
    </div>

    <div class="level breadcrumbs is-mobile">
        <div class="level-left">

            <a class="level-item"href="{{ route( 'admin.dashboard.index' ) }}">Dashboard</a>
            <span class="level-item separator">&gt</span>
            <a class="level-item" href="{{ route( 'admin.programs.index' ) }}">Outreach Programs</a>
            <span class="level-item separator">&gt</span>
            <span class="level-item">Edit</span>

        </div>
    </div>

@endsection

@section( 'section-menu' )

    @include( 'admin.programs.partials.tabs' )

@endsection

@section('section-content')

    <survey :program-id="{{ $program->id }}"  :use-local-storage="false" :show-welcome-message="false"></survey>

@endsection