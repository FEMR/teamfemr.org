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
                                    <!--Pull data from Trip Database Survey-->
                                    var name = markers[i].getAttribute("teamname");
                                   // var address = markers[i].getAttribute("lat");
                                    var name = "";
                                    for (var j = markers[i].attributes.length-3; j >-1 ; j--)
                                    {
                                        name += markers[i].getAttribute("teamname"+j) +"<br/>" ;
                                    }
                                   // var name ='<a href="tripsurvey" >' + markers[i].getAttribute("teamname"+0)+ '</a>';
                                    var address = markers[i].getAttribute("id");
                                    var type = markers[i].getAttribute("type");

                                    <!--Pull latitude and longitude data from the Trip Database survey-->
                                    var point = new google.maps.LatLng(
                                            parseFloat(markers[i].getAttribute("lat")),
                                            parseFloat(markers[i].getAttribute("lng")));
                                    var html = "<b>" + name + "</b> <br/>" + address;
                                    //var icon = customIcons[type] || {};

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

        @foreach($surveys as $survey)
            <table class="table">
            <ul>
                <a name="TripDatabase"></a>
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
</div>

@endsection