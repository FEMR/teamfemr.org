@extends ('layouts.app')

@section('content')

        <!--Trip Database web page-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><center><h1>Trip Database</h1></center></div>

                <!--Link to Trip Database survey-->
                <h2 style="float:left; width:150px;"><a href="tripsurvey/create">Can't find your team, click here.</a></h2>
                <div class="panel-body">
                    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
                    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

                    <!--Building the Google maps Graphical User Interface (GUI) into the web page-->
                    <title>PHP/MySQL & Google Maps Example</title>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPVo3nvRyyRrnXvB-nIII6z13evOGCKkM"
                            type="text/javascript">

                    </script>

                    <script type="text/javascript">
                        //<![CDATA[

                        function load() {
                            var map = new google.maps.Map(document.getElementById("map"), {
                                center: new google.maps.LatLng(0.6145, 0.3418),
                                zoom: 2,
                                mapTypeId: 'roadmap'
                            });
                            var infoWindow = new google.maps.InfoWindow;

                            <!--Change this depending on the name of your PHP file-->
                            downloadUrl("/users/xml", function(data) {
                                var xml = data.responseXML;

                                <!--Create new marker-->
                                var markers = xml.documentElement.getElementsByTagName("marker");

                                <!--Use a for loop to iterate through all of the pop up pins/markers and input the information-->
                                for (var i = 0; i < markers.length; i++)
                                {
                                    var name = "";
                                    for (var j = ((markers[i].attributes.length-2)/2)-1; j >-1 ; j--)
                                    {

                                        name += "<a href=\"#"+ markers[i].getAttribute("id"+j) +"\">" + markers[i].getAttribute("teamname"+j) + "</a>" +"<br>" ;
                                    }
                                    <!--Pull latitude and longitude data from the Trip Database survey-->
                                    var point = new google.maps.LatLng(
                                            parseFloat(markers[i].getAttribute("lat")),
                                            parseFloat(markers[i].getAttribute("lng")));
                                    var html =  name  ;


                                    <!--Create new pop up pin on the map interface (based on the latitude and longitude entered into the Trip Database Survevy)-->
                                    var marker = new google.maps.Marker({
                                        map: map,
                                        position: point
                                    });
                                    bindInfoWindow(marker, map, infoWindow, html);
                                }
                            });
                        }

                        function bindInfoWindow(marker, map, infoWindow, html) {
                            google.maps.event.addListener(marker, 'click', function() {
                                infoWindow.setContent(html);
                                infoWindow.open(map, marker);
                            });
                        }

                        function downloadUrl(url, callback) {
                            var request = window.ActiveXObject ?
                                    new ActiveXObject('Microsoft.XMLHTTP') :
                                    new XMLHttpRequest;

                            request.onreadystatechange = function() {
                                if (request.readyState == 4) {
                                    request.onreadystatechange = doNothing;
                                    callback(request, request.status);
                                }
                            };

                            request.open('GET', url, true);
                            request.send(null);
                        }

                        function doNothing() {}

                        //]]>
                    </script>
                    </head>
                    <body onload="load()">
                    <div id="map" style="width: 700px; height: 400px"></div>


                    </body>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">


        @foreach($surveys as $id => $survey)
            <div style="width:800px; margin:0 auto;">
                <table class="table table-striped">

                <ul class="list-unstyled">
                    <a name={{$survey->id}}></a>
                    @if (Auth::guest() || !Auth::user()->moderator())
                        <h3 data-toggle="collapse" data-target="#<?php echo $survey->id ?>"><a><label  style="font-weight: bold ; width: 25%; display:inline-block">Team Name:</label> {{$survey->teamname}}</a> </h3>
                    @elseif (Auth::user()->moderator())
                        <h3 data-toggle="collapse" data-target="#<?php echo $survey->id ?>"><a><label  style="font-weight: bold ; width: 25%; display:inline-block">Team Name:</label> {{$survey->teamname}}</a>
                        <a href ="/surveys/<?php echo $survey->id ?>/edit" class="btn btn-primary btn-sm">EDIT</a></h3>
                    @endif



                <div id="<?php echo $survey->id ?>" class="collapse">
                    <li><label  style="font-weight: bold ; width: 25%; display:inline-block">Initiated:</label> {{$survey->initiated}}</li>

                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Total Matriculants:</label> {{$survey->totalmatriculants}}</li>
                    <li><label  style="font-weight: bold ; width: 25%; display:inline-block">Med School Terms:</label> {{$survey->medschoolterms}}</li>
                    <li><label  style="font-weight: bold ; width: 25%; display:inline-block">Aiding Schools:</label>{{$survey->aidingschools}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Total Per Year:</label>{{$survey->totalperyear}}</li>
                    @foreach($survey->places as $place)
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Location:</label>{{$place->place}}</li>
                    @endforeach
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Months of Travel:</label>{{$survey->monthsoftravel}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Partner NGO:</label>{{$survey->partnerngo}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Faculty:</label>{{$survey->faculty}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">App. Process:</label>{{$survey->appprocess}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Program Elements:</label>{{$survey->programelements}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Financial Support:</label>{{$survey->finsupport}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Faculty Time:</label>{{$survey->facultytimeallotted}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Admin Support:</label>{{$survey->adminsupport}}</li>
                    <li><label style="font-weight: bold ; width: 25%; display:inline-block">Contact Info:</label>{{$survey->contactinfo}}</li>
                    {{--<li>{{ $survey->places->first() }}</li>--}}

</div>


                </ul>
                    {{--</tr>--}}
            </div>
            </table>
    </div>
    @endforeach
</div>

@endsection