@extends ('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Trip Database</center></div>
                <h2 style="float:left; width:150px;"><a href="tripsurvey/create">Can't find your team, click here.</a></h2>
                <div class="panel-body">
                    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
                    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
                    <title>PHP/MySQL & Google Maps Example</title>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPVo3nvRyyRrnXvB-nIII6z13evOGCKkM"
                            type="text/javascript"></script>
                    <script type="text/javascript">
                        //<![CDATA[

                        var customIcons = {
                            restaurant: {
                                icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
                            },
                            bar: {
                                icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
                            }
                        };

                        function load() {
                            var map = new google.maps.Map(document.getElementById("map"), {
                                center: new google.maps.LatLng(0.6145, 0.3418),
                                zoom: 2,
                                mapTypeId: 'roadmap'
                            });
                            var infoWindow = new google.maps.InfoWindow;

                            // Change this depending on the name of your PHP file
                            downloadUrl("/users/xml", function(data) {
                                var xml = data.responseXML;
                                var markers = xml.documentElement.getElementsByTagName("marker");
                                for (var i = 0; i < markers.length; i++) {
                                    var name = "";
                                    for (var j = markers[i].attributes.length-3; j >-1 ; j--)
                                    {
                                        name += markers[i].getAttribute("teamname"+j) ;
                        }
                                   // var name ='<a href="tripsurvey" >' + markers[i].getAttribute("teamname"+0)+ '</a>';
                                    var address = markers[i].getAttribute("id");
                                    var point = new google.maps.LatLng(
                                            parseFloat(markers[i].getAttribute("lat")),
                                            parseFloat(markers[i].getAttribute("lng")));
                                    var html = "<b>" + name + "</b> <br/>" + address;
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
                    <div id="map" style="width: 500px; height: 300px"></div>
                    </body>

                    </body>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection