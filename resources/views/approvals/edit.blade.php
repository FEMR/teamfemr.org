@extends('layouts.appFemr')

@section('content')
    
                    <div class="panel-heading"><center><h1>Approvals Needed</h1></center></div>
                    <div class="panel-body">
                        <div><a href ="/deletes" class="btn btn-danger btn-sm">View Deleted Surveys</a>
                            <hr>
                            @if( $surveys->count() > 0 )
                            <div class="table-responsive">

                                {!! Form::open([ 'method' => 'PATCH', 'action' => 'ApprovalsController@update' ]) !!}
                                <table class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th>Approve</th>
                                            <th>Delete</th>
                                            <th>Team Name</th>
                                            <th>Locale</th>
                                            <th>Months of Travel</th>
                                            <th>Contact Info</th>
                                        </tr>
                                    </thead>

                                    @foreach($surveys as $survey)

                                        <tr>

                                            <td>
                                                {!! Form::checkbox('approvals[]', $survey->id, null) !!}
                                            </td>
                                            <td>
                                                {!! Form::checkbox('deletes[]', $survey->id, null) !!}
                                            </td>
                                            <td><a href="#teamname">{{$survey->teamname}}</a></td>
                                            <td> @foreach($survey->places as $place)
                                                    <li>{{$place->place}}</li>
                                                @endforeach</td>
                                            <td>{{$survey->monthsoftravel}}</td>
                                            <td>{{$survey->contactinfo}}</td>

                                        </tr>


                                    @endforeach

                                </table>
                                                                <div class="form-group">
                                    {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                            @else
                            <p>There are no Surveys to approve.</p>
                            @endif
                                {{--<div><h5><a href ="/deletes" class="btn btn-primary btn-sm">View Deleted Surveys</a></h5></div>--}}

                    </div>
                    </div>
            </div>
        </div>
    </div>
@endsection