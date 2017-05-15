
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
            <a class="level-item" href="{{ route( 'admin.programs.edit', [ $school->id, $program->id ] ) }}">{{ $program->name }}</a>
            <span class="level-item separator">&gt</span>
            <a class="level-item" href="{{ route( 'admin.papers.index', [ $school->id, $program->id ] ) }}">Papers</a>
            <span class="level-item separator">&gt</span>
            <span class="level-item">Archived</span>

        </div>
    </div>

@endsection

@section( 'section-menu' )

    @include( 'admin.programs.papers.partials.tabs' )

@endsection

@section('section-content')

    @if( $program->papers->count() > 0 )

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Url</th>
                </tr>
            </thead>

            <tbody>
                @foreach( $program->papers as $paper )
                <tr>

                    <td>
                        {!! Form::open([ 'method' => 'post', 'route' => [ 'admin.papers.restore', $school->id, $program->id, $paper->id ] ]) !!}
                        <button type="submit" class="button is-small" title="restore">
                            <span class="icon is-small"><i class="fa fa-undo"></i></span>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $paper->title }}</td>
                    <td>{{ $paper->url }}</td>

                </tr>
                @endforeach
            </tbody>

        </table>

    @else

        <p>There are no archived papers</p>

    @endif

@endsection