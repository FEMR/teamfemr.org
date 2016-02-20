@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Trip Database</center></div>
                <h2 style="float:left; width:150px;"><a href="tripsurvey/create">Can't find your team, click here.</a></h2>
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

                            <?php
                            foreach($surveys as $survey) {
                            $lng =  $survey->lng;
                            $lat = $survey->lat;
                                $team = $survey->teamname;
                            ?>
                            // Creating a marker and positioning it on the map
                            

                            var infowindow2 = new google.maps.InfoWindow({
                                content: "<?php echo $team ?>"
                            });
                             var marker2 = new google.maps.Marker({
                                position: new google.maps.LatLng(<?php echo $lat ?>, <?php echo $lng; ?>),
                                map: map

                            });
                            marker2.addListener('click', function() {
                                infowindow2.open(map, marker2);
                            });




                                    <?php
                                    }
                                    ?>


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