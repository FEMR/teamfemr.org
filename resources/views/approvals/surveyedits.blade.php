@extends('layouts.appFemr')

{{--**************************Trying to have user specific nav bar *******************************************--}}
{{--@if(Auth::user()->isAdmin())--}}
{{--@include('navigation.admin');--}}
{{--@endIf--}}
{{--**********************************************************************************************--}}

@section('content')

                    <div class="panel-heading"><center><h1>Surveys</h1></center></div>
                    <div class="panel-body">


                            <div class="table-responsive">

                                <table class="table table-striped">

                                    <thead>
                                    <tr>
                                        <th>Team Name</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>

                                    @foreach($surveys as $survey)

                                        <tr>
                                            <td><h3>{{$survey->teamname}}</h3></td>
                                            <td><a href ="/surveys/<?php echo $survey->id ?>/edit" class="btn btn-primary btn-sm">EDIT</a></td>

                                        </tr>


                                    @endforeach

                                </table>
                                <div class="form-group">
                                </div>

                            </div>
                    </div>

@endsection