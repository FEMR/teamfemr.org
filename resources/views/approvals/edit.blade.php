@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>Approvals Needed</h1></center></div>
                    <div class="panel-body">
                        <form method = "POST" action="/approvals/">
                            {{csrf_field()}}
                        {{--<form method = "POST" action="/approvals/{{$status->id}}">--}}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                {{--<textarea name="status" class="form-control">{{$Survey->status}}</textarea>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                                {{--<button type="submit" class = "btn btn-primary">Update Status</button>--}}
                            {{--</div>--}}


                            {{--//*************************************************************************--}}


                                <div class="table-responsive">

                                    <table class="table">
                                        @foreach($Survey as $survey)

                                            <tr>
                                                <td><a href="#teamname">{{$survey->teamname}}</a></td>
                                                <td>{{$survey->visitedlocale}}</td>
                                                <td>{{$survey->monthsoftravel}}</td>
                                                <td>{{$survey->contactinfo}}</td>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            {{--<input type="checkbox"> Approve--}}
                                                            {!! Form::checkbox('status'.$survey->id,1, null, ['class'=> 'form-control']) !!}
                                                            Approved
                                                        </label>
                                                    </div>
                                                </td>


                                            </tr>


                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Submit for Approval', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                            </form>

                        {{--{!! Form::close() !!}--}}
                        </div>
                    </div>
@endsection