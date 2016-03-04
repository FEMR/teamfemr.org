@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>Approvals Needed</h1></center></div>
                    <div class="panel-body">
                    {{--@if($errors->any())--}}
                        {{--<div class="alert alert-danger">--}}
                            {{--@foreach($errors->all() as $error)--}}
                                {{--<p>{{ $error }}</p>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    <div class="form-group">
                        {{--//loops through survey database and lists select columns in a table--}}
                        {{--{!! Form::open(['url' => 'tripsurvey']) !!}--}}

                    {{--{!! Form::model($Survey, ['method' => 'PATCH','route' => ['approvals.update', $Survey->id]]) !!}--}}


{{--                        {!! Form::model($Survey, ['method' => 'store']) !!}--}}
                        {{--{!! Form::open(['url' => 'approvals/edit']) !!}--}}
                            <form action="/approvals" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
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
                                                    {!! Form::checkbox('approved[]',1, null, ['class'=> 'form-control']) !!}
                                                    Approved
                                                </label>
                                            </div>

                                        </td>


                                    </tr>


                                @endforeach
                            </table>

                            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                            </form>

                        {{--{!! Form::close() !!}--}}
                        </div>
                    </div>
@endsection