@extends ('layouts.app')


@section('content')
    <div class="survey">
        <section class="section">
            <div class="container">

                @if( ! is_null( $user ) && $user->can( 'update-survey', $program ) )
                    <p class="back-button"><a class="button is-link" href="{{ route( 'programs.index' ) }}">&laquo; All Surveyed Programs</a></p>
                @endif

                <h1 class="title">Survey</h1>

                <hr>

                <survey :program-id="{{ $program->id }}"></survey>

            </div>
        </section>
    </div>
@endsection