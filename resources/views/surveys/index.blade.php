@extends ('layouts.app')


@section('content')
    <div class="survey">
        <section class="section">
            <div class="container">

                <h1 class="title">Survey</h1>

                <hr>

                <survey :program-id="1"></survey>

            </div>
        </section>
    </div>
@endsection