@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>HOME</h1></center></div>

                    <div class="panel-body">
                        @foreach( $users as $user )
                            <p>{{ $user->name }} - {{ $user->email }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




