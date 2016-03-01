@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>Approvals Needed</h1></center></div>
    <div class="form-group">
        @foreach($Survey as $survey)
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td><a href="#teamname">{{$survey->teamname}}</a></td>
                        <td>{{$survey->visitedlocale}}</td>
                        <td>{{$survey->monthsoftravel}}</td>
                        <td>{{$survey->contactinfo}}</td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Approve
                                </label>
                            </div>
                        </td>


                    </tr>
            </table>
            </div>
        @endforeach

    </div>
<div align='center'>
        <button type="submit" class="btn btn-primary btn-lgt">Submit</button>
</div>
                    <a name="teamname"></a>
                    @foreach($Survey as $survey)
                        <div class="table-responsive">
                            <table class="table">

                        <ul style="list-style-type:none">
                            <h3>{{$survey->teamname}}</h3>
                            <li>{{$survey->totalmatriculants}}</li>
                            <li>{{$survey->medschoolterms}}</li>
                            <li>{{$survey->aidingschools}}</li>
                            <li>{{$survey->totalperyear}}</li>
                            <li>{{$survey->visitedlocale}}</li>
                            <li>{{$survey->monthsoftravel}}</li>
                            <li>{{$survey->partnerngo}}</li>
                            <li>{{$survey->faculty}}</li>
                            <li>{{$survey->appprocess}}</li>
                            <li>{{$survey->programelements}}</li>
                            <li>{{$survey->finsupport}}</li>
                            <li>{{$survey->facultytimeallotted}}</li>
                            <li>{{$survey->adminsupport}}</li>
                            <li>{{$survey->contactinfo}}</li>
                        </ul>
                    </table>
                    </div>
    @endforeach
@endsection

{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-10 col-md-offset-1">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading"><center><h2>Approvals</h2></center></div>--}}

                {{--<div class="panel-body">--}}
                    {{--<table align="left" border="0" cellpadding="1" cellspacing="10" height="29" width="728" style="font-family:arial,helvetica,sans-serif;font-size: 12px;">--}}
                        {{--<tr>--}}
                            {{--<th width="10%">Teamname</th>--}}
                            {{--<th width="10%">Initiated</th>--}}
                            {{--<th width="5%">Total Mat.</th>--}}
                            {{--<th width="10%">Medical Stu. Env.</th>--}}
                            {{--<th width="10%">Aiding Schools</th>--}}
                            {{--<th width="5%">Total per Year</th>--}}
                            {{--<th width="10%">Visited Locale</th>--}}
                            {{--<th width="5%">Month of Travel</th>--}}
                            {{--<th width="10%">NGO/Partner</th>--}}
                            {{--<th width="10%">Faculty</th>--}}
                            {{--<th width="10%">App. Process</th>--}}
                            {{--<th width="10%">Program Elements</th>--}}
                            {{--<th width="10%">Financial Support</th>--}}
                            {{--<th width="10%">Fac. Time Allo.</th>--}}
                            {{--<th width="10%">Admin Support</th>--}}
                            {{--<th width="10%">Contact Info</th>--}}
                            {{--<th width="10%">Status</th>--}}

                        {{--</tr>--}}
                    {{--</table>--}}
                   {{--@foreach($Survey as $survey)--}}
                       {{--<table align="left" border="0" cellpadding="1" cellspacing="10" height="29" width="728" style="font-family:arial,helvetica,sans-serif;font-size: 12px;">--}}
                        {{--<table class="table table-striped">--}}
                           {{--<tr>--}}
                               {{--<td width="10%"><b>{{$survey->teamname}}</b></td>--}}
                               {{--<td width="10%">{{$survey->initiated}}</td>--}}
                               {{--<td width="5%">{{$survey->totalmatriculants}}</td>--}}
                               {{--<td width="10%">{{$survey->medschoolterms}}</td>--}}
                               {{--<td width="10%">{{$survey->aidingschools}}</td>--}}
                               {{--<td width="5%">{{$survey->totalperyear}}</td>--}}
                               {{--<td width="10%">{{$survey->visitedlocale}}</td>--}}
                               {{--<td width="5%">{{$survey->monthsoftravel}}</td>--}}
                               {{--<td width="10%">{{$survey->partnerngo}}</td>--}}
                               {{--<td width="10%">{{$survey->faculty}}</td>--}}
                               {{--<td width="10%">{{$survey->appprocess}}</td>--}}
                               {{--<td width="10%">{{$survey->programelements}}</td>--}}
                               {{--<td width="10%">{{$survey->finsupport}}</td>--}}
                               {{--<td width="10%">{{$survey->facultytimeallotted}}</td>--}}
                               {{--<td width="10%">{{$survey->adminsupport}}</td>--}}
                               {{--<td width="10%">{{$survey->contactinfo}}</td>--}}
                               {{--<td width="10%">{{$survey->status}}</td>--}}

                           {{--</tr>--}}
                       {{--</table>--}}
                        {{--@foreach($Survey as $survey)--}}
                            {{--<table>--}}
                        {{--<ul>--}}
                            {{--<li><b>{{$survey->teamname}}</b></li>--}}
                            {{--<li>{{$survey->totalmatriculants}}</li>--}}
                            {{--<li>{{$survey->medschoolterms}}</li>--}}
                            {{--<li>{{$survey->aidingschools}}</li>--}}
                            {{--<li>{{$survey->totalperyear}}</li>--}}
                            {{--<li>{{$survey->visitedlocale}}</li>--}}
                            {{--<li>{{$survey->monthsoftravel}}</li>--}}
                            {{--<li>{{$survey->partnerngo}}</li>--}}
                            {{--<li>{{$survey->faculty}}</li>--}}
                            {{--<li>{{$survey->appprocess}}</li>--}}
                            {{--<li>{{$survey->programelements}}</li>--}}
                            {{--<li>{{$survey->finsupport}}</li>--}}
                            {{--<li>{{$survey->facultytimeallotted}}</li>--}}
                            {{--<li>{{$survey->adminsupport}}</li>--}}
                            {{--<li>{{$survey->contactinfo}}</li>--}}
                        {{--</ul>--}}
                            {{--</table>--}}
                   {{--@endforeach--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}