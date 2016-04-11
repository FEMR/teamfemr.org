@extends('layouts.appFemr')

@section('content')


                    <div class="panel-heading"><center><h1>All Programs</h1></center></div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach($surveys as $id => $survey)
                                <div style="width:600px; margin:0 auto;">
                                    <table class="table table-striped table-responsive" style="table-layout:fixed">
                                        <tr>
                                            <td valign="top"><label style="font-weight: bold ; font-size: 16px">Team Name:</label></td>

                                            <a name=<?php echo ("jump".$survey->id) ?>></a>
                                            @if (Auth::guest() || !Auth::user()->moderator())
                                                <td data-toggle="collapse" data-target="#<?php echo $survey->id ?>"><label  style="font-weight: bold ; font-size: 20px"><a> {{$survey->teamname}}</a> </label></td>
                                            @elseif (Auth::user()->moderator())
                                                <td data-toggle="collapse" data-target="#<?php echo $survey->id ?>"><label  style="font-weight: bold ; font-size: 20px"><a> {{$survey->teamname}}</a></label></td>
                                                <td></td>
                                                <td><a href ="/surveys/<?php echo $survey->id ?>/edit" class="btn btn-primary btn-sm">EDIT</a></td>
                                                @endif
                                                </td>
                                        </tr>
                                    </table>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <div id="<?php echo $survey->id ?>" class="collapse">
                                            <ul class="list-unstyled">
                                                <li><label  style="font-weight: bold ; width: 30%; display:inline-block">Initiated:</label> {{$survey->initiated}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Total Matriculants:</label> {{$survey->totalmatriculants}}</li>
                                                <li><label  style="font-weight: bold ; width: 30%; display:inline-block">Med School Terms:</label> {{$survey->medschoolterms}}</li>
                                                <li><label  style="font-weight: bold ; width: 30%; display:inline-block">Aiding Schools:</label>{{$survey->aidingschools}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Total Per Year:</label>{{$survey->totalperyear}}</li>
                                                @foreach($survey->places as $place)
                                                    <li><label style="font-weight: bold ; width: 30%; display:inline-block">Location:</label>{{$place->place}}</li>
                                                @endforeach
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Months of Travel:</label>{{$survey->monthsoftravel}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Partner NGO:</label>{{$survey->partnerngo}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Faculty:</label>{{$survey->faculty}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">App. Process:</label>{{$survey->appprocess}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Program Elements:</label>{{$survey->programelements}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Financial Support:</label>{{$survey->finsupport}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Faculty Time:</label>{{$survey->facultytimeallotted}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Admin Support:</label>{{$survey->adminsupport}}</li>
                                                <li><label style="font-weight: bold ; width: 30%; display:inline-block">Contact Info:</label>{{$survey->contactinfo}}</li>
                                            </ul>

                                        </div>
                                    </td>
                                </tr>

                            </table>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

