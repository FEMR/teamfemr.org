@extends('layouts.appFemr')

@section('content')

                    <div class="panel-heading"><center><h1>Deleted Surveys</h1></center></div>

                    <div class="panel-body">
                        <div class="table-responsive">

                            {!! Form::open([ 'method' => 'POST', 'action' => 'LitApprovalsController@viewDeletes' ]) !!}
                            <table class="table table-striped">

                                <thead>
                                <tr>
                                    <th>Contributor Name</th>
                                    <th>Author Name</th>
                                    <th>Link</th>
                                </tr>
                                </thead>

                                @foreach($literatures as $literature)

                                    <tr>

                                        <td>{{$literature->contributorName}}</td>
                                        <td>{{$literature->authorName}}</td>
                                        <td>{{$literature->addLink}}</td>


                                    </tr>


                                @endforeach

                            </table>
                        </div>


@endsection