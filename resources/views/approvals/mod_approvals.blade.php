@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>Moderator Approvals Needed</h1></center></div>
                    <div class="panel-body">

                        @if( $users->count() > 0 )
                            <div class="table-responsive">

                                {!! Form::open([ 'method' => 'PATCH', 'action' => 'ModApprovalsController@update' ]) !!}
                                <table class="table table-striped">

                                    <thead>
                                    <tr>
                                        <th>Approve</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>

                                    @foreach($users as $user)

                                        <tr>

                                            <td>
                                                {!! Form::checkbox('isModerator[]', $user->id, null) !!}
                                            </td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>


                                        </tr>


                                    @endforeach

                                </table>
                                <div class="form-group">
                                    {!! Form::submit('Submit Approvals', ['class' => 'btn btn-primary form-control']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        @else
                            <p>There are no Moderators to approve.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection