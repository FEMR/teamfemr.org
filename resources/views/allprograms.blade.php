@extends('layouts.appFemr')

@section('content')


<div class="panel-heading"><center><h1>All Programs</h1></center></div>
    <div class="panel-body">
        <div><a href ="/tripdatabase" class="btn btn-danger btn-sm">RETURN TO MAP</a>
            <hr>
        </div>
        <div class="form-group">
            @foreach($surveys as $id => $survey)
                <div style="width:100%; margin:0 auto;">
                    <table class="table table-striped table-responsive" style="table-layout:fixed">
                        <tr>

                            @if ( Auth::guest() || !Auth::user()->moderator() )
                                <td data-toggle="collapse" data-target="#<?php echo $survey->id ?>"><label  style="width: 60%; display:inline-block"><a> {{$survey->teamname}}</a></label></td>
                                <td><-click to expand</td>
                            @elseif ( Auth::user()->moderator() )
                                <td data-toggle="collapse" data-target="#<?php echo $survey->id ?>"><label  style="width: 60%; display:inline-block"><a> {{$survey->teamname}}</a></label></td>
                                <td><-click to expand</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href ="/surveys/<?php echo $survey->id ?>/edit" class="btn btn-primary btn-sm">EDIT</a></td>
                            @endif
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td>
                                <div class="row">
                                    <div id="<?php echo $survey->id ?>" class="collapse">
                                        <div class="col-md-6"  >
                                            <ul class="list-unstyled">

                                                <li><label  style="width: 30%; display:inline-block">Initiated:</label> {{$survey->initiated}}</li>
                                                <li><label style="width: 30%; display:inline-block">Total Matriculants:</label> {{$survey->totalmatriculants}}</li>
                                                <li><label  style="width: 30%; display:inline-block">Med School Terms:</label> {{$survey->medschoolterms}}</li>
                                                <li><label  style="width: 30%; display:inline-block">Aiding Schools:</label>{{$survey->aidingschools}}</li>
                                                <li><label style="width: 30%; display:inline-block">Total Per Year:</label>{{$survey->totalperyear}}</li>
                                                <li><label style="width: 30%; display:inline-block">Faculty:</label>{{$survey->faculty}}</li>
                                                <li><label style="width: 30%; display:block">App. Process:</label>{{$survey->appprocess}}</li>
                                                <li><label style="width: 30%; display:block">Program Elements:</label>{{$survey->programelements}}</li>
                                                <li><label style="width: 30%; display:block">Financial Support:</label>{{$survey->finsupport}}</li>
                                                <li><label style="width: 30%; display:block">Faculty Time:</label>{{$survey->facultytimeallotted}}</li>
                                                <li><label style="width: 30%; display:block">Admin Support:</label>{{$survey->adminsupport}}</li>
                                                <li><label style="width: 30%; display:inline-block">Contact Info:</label>{{$survey->contactinfo}}</li>

                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                @foreach($survey->trips as $idx => $trip)
                                                    <li><label style="width: 50%; display:inline-block ">Location:</label>{{$trip->place->place}}</li>
                                                    <li><label style="font-weight: bold ;width: 50%; display:inline-block ">Months of Travel:</label>{{$trip->monthsoftravel}}</li>

                                                    <li><label style="font-weight: bold ; width: 50%; display:inline-block">Partner NGO:</label>{{$trip->partnerngo}}</li>
                                                    <br>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

