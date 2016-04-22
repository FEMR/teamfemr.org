@extends ('layouts.appFemr')

@section('content')

<!--Trip Database web page-->
<div class="panel-heading">

                <center><h1>Trip Database</h1></center>

                </div>
                <!--Link to Trip Database survey-->
                <div class="panel-body">


                    <div><a href ="/tripsurvey/create" class="btn btn-danger btn-sm">ADD PROGRAM</a>
                        <a href ="/allprograms" class="btn btn-success btn-sm">SHOW ALL PROGRAMS</a>
                        <hr>
                    </div>
                    <!--Building the Google maps Graphical User Interface (GUI) into the web page-->
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPVo3nvRyyRrnXvB-nIII6z13evOGCKkM"
                            type="text/javascript"></script>

                    <script type="text/javascript">
                        //<![CDATA[

                        $( document ).ready( function(){

                            load();
                        });

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

                                        name += "<a "
//                                        + " href=\"../tripsurvey/"
//                                        + markers[i].getAttribute("id"+j)
                                        + " target=\"popup\""
                                        + " onclick=\"window.open('../tripsurvey/"+ markers[i].getAttribute("id"+j)+ "','name','width=1000,height=500')" + " "
                                        +"\">"

                                                + markers[i].getAttribute("teamname"+j) + "</a>" +"<br>" ;
                                    }
                                    <!--Pull latitude and longitude data from the Trip Database survey-->
                                    var point = new google.maps.LatLng(
                                            parseFloat(markers[i].getAttribute("lat")),
                                            parseFloat(markers[i].getAttribute("lng")));
                                    var html =  name;


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
                    <div id="map" style="width: 100%; height: 500px; margin: 0 auto;"></div>
<br>
{{--*************BELOW MAP SURVEY LIST****************************************************************************--}}
    {{--<div class="form-group" id="accordion" >--}}
        {{--Possible search functionality}}}--}}
      {{--<form method="post" action="search.php?go" id="searchform">--}}
      {{--<input type="text" name="name">--}}
      {{--<input type="submit" name="submit" value="Search">--}}
      {{--</form>--}}

{{--Displays the database--}}
     {{----}}
{{--</div>--}}

</div>

@endsection