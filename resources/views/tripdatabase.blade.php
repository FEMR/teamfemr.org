@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Trip Database</center></div>
                <h2 style="float:left; width:150px;"><a href="homestead.app/usersurvey">Can't find your team, click here.</a></h2>
                <div class="panel-body">
                <section>
                    <head>
                        <style>
                            #map {
                                width: 700px;
                                height: 500px;
                            }
                        </style>
                    </head>
                    <body>

                    <div id="map"></div>
                    <script>
                        function initMap() {
                            var mapDiv = document.getElementById('map');
                            var map = new google.maps.Map(mapDiv, {
                                center: {lat: 44.540, lng: -78.546},
                                zoom: 2
                            });
                            var marker = new google.maps.Marker({
                                position: {lat: 44.540, lng: -78.54},
                                map: map,
                                title: 'Trips'
                            });
                            var contentString = '<div id="content">' +
                                    '<div id=siteNotice">'+
                                            '</div>' +
                                            '<div id ="bodyContent">' +
                                            '<a href="https://wayne.edu/">Wayne State University</a>' +
                                            '</div>' +
                                            '</div>';
                            
                            var infowindow = new google.maps.InfoWindow({
                                content: contentString
                            });
                            marker.addListener('click', function() {
                                infowindow.open(map, marker);
                            });
                        }
                    </script>
                    <script src = "https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection