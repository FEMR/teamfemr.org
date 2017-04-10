@extends ('layouts.admin')

@section( 'section-header' )
    <section class="hero">
        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Map Testing
                </h1>
                <h2 class="subtitle">
                    Somewhere to play around with searching for locations on a map and getting their location information
                </h2>
            </div>
        </div>
        <hr />
    </section>
@endsection

@section('section-content')

    <section class="section">
        <div class="content">

            <div class="field">
                <label class="label">Address</label>
                <p class="control">
                    <input id="autocomplete"
                           class="input"
                           placeholder="Enter your address"
                           onFocus="geolocate"
                           type="text"/>
                </p>
            </div>
            <div id="map" style="width: 100%; height: 350px;"></div>
            <script>

                var MapModule = (function(){

                    var map;
                    var markers = [];
                    var bounds;
                    var autocomplete;

                    // Map response keys to form fields
                    var componentForm = {
                        street_number: 'short_name',
                        route: 'long_name',
                        locality: 'long_name',
                        administrative_area_level_1: 'short_name',
                        country: 'long_name',
                        postal_code: 'short_name'
                    };

                    function placeWasChanged() {

                        var place = autocomplete.getPlace();
                        addMarkers( place );

                        // Figure out how to get access to the
                        console.log( place );

                        document.getElementById('autocomplete').value = '';
                    }

                    function fillInAddress() {
                        // Get the place details from the autocomplete object.
                        // var place = autocomplete.getPlace();
                        //
                        // for (var component in componentForm) {
                        //     document.getElementById(component).value = '';
                        //     document.getElementById(component).disabled = false;
                        // }
                        //
                        // // Get each component of the address from the place details
                        // // and fill the corresponding field on the form.
                        // for (var i = 0; i < place.address_components.length; i++) {
                        //     var addressType = place.address_components[i].types[0];
                        //     if (componentForm[addressType]) {
                        //         var val = place.address_components[i][componentForm[addressType]];
                        //         document.getElementById(addressType).value = val;
                        //     }
                        // }
                    }


                    // Bias the autocomplete object to the user's geographical location,
                    // as supplied by the browser's 'navigator.geolocation' object.
                    function geolocate() {

                        if (navigator.geolocation) {

                            // TODO -- we probably don't need this, nearby locations are not our focus
                            navigator.geolocation.getCurrentPosition(function(position) {

                                var geolocation = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude
                                };

                                var circle = new google.maps.Circle({
                                    center: geolocation,
                                    radius: position.coords.accuracy
                                });

                                autocomplete.setBounds(circle.getBounds());
                            });
                        }

                    }

                    var addMarkers = function( place ){

                        if( typeof place == "undefined" ) return;

                        console.log( place );

                        var location = place.geometry.location;
                        markers.push(
                                new google.maps.Marker({
                                    position: location,
                                    map: map
                                })
                        );

                        bounds.extend(location);

                        if( markers.length >  1 ) {

                            map.fitBounds(bounds);
                        }
                    };

                    var init = function(){

                        bounds = new google.maps.LatLngBounds();

                        map = new google.maps.Map( document.getElementById('map'), {
                            center: { lat: 0.0, lng: 0.0 },
                            zoom: 2,
                            scrollwheel: false
//                    minZoom: 19
                        });

                        // Create the autocomplete object, restricting the search to geographical
                        // location types.
                        autocomplete = new google.maps.places.Autocomplete(
                                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                                {types: ['geocode']});

                        // When the user selects an address from the dropdown, populate the address
                        // fields in the form.
                        autocomplete.addListener('place_changed', placeWasChanged );
                    };

                    return {

                        init: init,
                        geolocate: geolocate
                    };

                })();

                function geolocate(){

                    MapModule.geolocate();
                }

                function initMap(){

                    MapModule.init();
                }

            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key={{ env( 'GMAPS_API_KEY' ) }}&libraries=places&callback=initMap"
                    async defer></script>
        </div>
    </section>

@endsection