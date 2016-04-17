<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/app.css" rel="stylesheet">
{{--<link href="/css/literatureBank.css" rel="stylesheet">--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans">
<script type="text/javascript" src="/js/main.js"></script>
<br>
<div class="container">
    <div class="row">

            <div class="panel panel-default">
<div class="panel-heading"><h1>{{$survey->teamname}}</h1></div>
                <div class="panel-body">
                    <div class="col-md-6">
    <p><label style="width: 30%; display:inline-block">Initiated:</label> {{$survey->initiated}}</p>
    <p><label style="width: 30%; display:inline-block">Total Matriculants:</label> {{$survey->totalmatriculants}}</p>
    <p><label style="width: 30%; display:inline-block">Med School Terms:</label> {{$survey->medschoolterms}}</p>
    <p><label style="width: 30%; display:inline-block">Aiding Schools:</label>{{$survey->aidingschools}}</p>
    <p><label style="width: 30%; display:inline-block">Total Per Year:</label>{{$survey->totalperyear}}</p>
    <p><label style="width: 30%; display:inline-block">Faculty:</label>{{$survey->faculty}}</p>
    <p><label style="width: 30%; display:block">App. Process:</label>{{$survey->appprocess}}</p>
    <p><label style="width: 30%; display:block">Program Elements:</label>{{$survey->programelements}}</p>
    <p><label style="width: 30%; display:block">Financial Support:</label>{{$survey->finsupport}}</p>
    <p><label style="width: 30%; display:block">Faculty Time:</label>{{$survey->facultytimeallotted}}</p>
    <p><label style="width: 30%; display:block">Admin Support:</label>{{$survey->adminsupport}}</p>
    <p><label style="width: 30%; display:inline-block">Contact Info:</label>{{$survey->contactinfo}}</p>
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