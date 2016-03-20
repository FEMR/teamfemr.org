@extends('layouts.app')

{{--**************************Trying to have user specific nav bar *******************************************--}}
{{--@if(Auth::user()->isAdmin())--}}
    {{--@include('navigation.admin');--}}
    {{--@endIf--}}
{{--**********************************************************************************************--}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>Approvals Needed</h1></center></div>
                    <div class="panel-body">
                        {{--

                        @rachel

                        Using the Form facade to open the form will:
                            - output the opening Form html tag
                            - add the csrf field
                            - Add the method PATCH field -- this is something odd. Some web servers don't accept PATCH
                                   requests nicely, so to account for this Laravel sends PATCH requests as a POST with
                                   the hidden method_field

                        It is good to tie your form submit urls to the controller paths or route names (ask me another
                            time about these). This way if you want to change /approvals to /admin/approvals you would
                            only need to make that change in the routes file.

                        --}}

                            @if( $surveys->count() > 0 )
                            <div class="table-responsive">

                                {!! Form::open([ 'method' => 'PATCH', 'action' => 'ApprovalsController@update' ]) !!}
                                <table class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th>Approve</th>
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
                                            <td><a href="#teamname">{{$survey->teamname}}</a></td>
                                            <td>{{$survey->visitedlocale}}</td>
                                            <td>{{$survey->monthsoftravel}}</td>
                                            <td>{{$survey->contactinfo}}</td>

                                        </tr>


                                    @endforeach

                                </table>
                                <div class="form-group">
                                    {!! Form::submit('Submit Approvals', ['class' => 'btn btn-primary form-control']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                            @else
                            <p>There are no Surveys to approve.</p>
                            @endif

                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection