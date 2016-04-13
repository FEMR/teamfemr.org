@extends('layouts.appFemr')

@section('content')

                    <div class="panel-heading"><center><h1>Edit this Survey</h1></center></div>
                 <div class="panel-body">


                            <form id="codeForm" method="POST" action="/surveys/{{$survey->id}}">

                                {{method_field('PATCH')}}
                                {{csrf_field()}}

                                <div class ="row">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="teamname">Team Name:</label>
                                            <textarea name="teamname" class="form-control">{{$survey->teamname}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="initiated">Initiated:</label>
                                            <textarea name="initiated" class="form-control">{{$survey->initiated}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="totalmatriculants">Total Matriculants:</label>
                                            <textarea name="totalmatriculants" class="form-control">{{$survey->totalmatriculants}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="medschoolterms">Medical School Terms:</label>
                                            <textarea name="medschoolterms" class="form-control">{{$survey->medschoolterms}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="aidingschools">Aiding Schools:</label>
                                            <textarea name="aidingschools" class="form-control">{{$survey->aidingschools}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="totalperyear">Total students per year:</label>
                                            <textarea name="totalperyear" class="form-control">{{$survey->totalperyear}}</textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="monthsoftravel">Months of travel:</label>
                                            <textarea name="monthsoftravel" class="form-control">{{$survey->monthsoftravel}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="partnerngo">Partner NGO:</label>
                                            <textarea name="partnerngo" class="form-control">{{$survey->partnerngo}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="faculty">Faculty:</label>
                                            <textarea name="faculty" class="form-control">{{$survey->faculty}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="appprocess">Application process:</label>
                                            <textarea name="appprocess" class="form-control">{{$survey->appprocess}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="programelements">Program Elements:</label>
                                            <textarea name="programelements" class="form-control">{{$survey->programelements}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="finsupport">Financial Support:</label>
                                            <textarea name="finsupport" class="form-control">{{$survey->finsupport}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="facultytimeallotted">Faculty Time Allotted:</label>
                                            <textarea name="facultytimeallotted" class="form-control">{{$survey->facultytimeallotted}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="adminsupport">Administrative Support:</label>
                                            <textarea name="adminsupport" class="form-control">{{$survey->adminsupport}}</textarea>
                                        </div>



                                    </div>
                                    <div class="col-sm-6">
                                        <h1>Current Trips</h1>

                                    @foreach($survey->trips as $idx => $trip)
                                            <div class="form-group">
                                                <label for="location">Location: <?php echo $idx+1 ?></label>
                                                <textarea name="location" class="form-control">{{$trip->place->place    }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="monthsoftravel">Months of Travel:</label>
                                                <textarea name="monthsoftravel" class="form-control">{{$trip->monthsoftravel    }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="partnerngo">Partner NGO: </label>
                                                <textarea name="partnerngo" class="form-control">{{$trip->partnerngo  }}</textarea>
                                            </div>

                                        @endforeach

                                            <div id="map" style="width: 420px; height: 300px"></div>
                                            <h1>Add Another Trip</h1>

                                            <div class="form-group">
                                                <label for="address">Visited City:</label>
                                                <input class="form-control" name="address" type="text" id="address">

                                                <label for="monthsoftravel">Months of Travel:</label>
                                                <input class="form-control" name="monthsoftravel" type="text" id="monthsoftravel">

                                                <label for="partnerngo">Partner NGO:</label>
                                                <input class="form-control" name="partnerngo" type="text" id="partnerngo">



                                                <input id="submit" type="button" value="Add Trip">
                                                <ul class="list-group" id="list">

                                                </ul>
                                            </div>

                                    </div>
                                    <input class="btn btn-primary form-control" type="submit" value="Submit">

                                    </div>
                            </form>

                 </div>



                    <script>
                        function initMap() {

                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 8,
                                center: {lat: -34.397, lng: 150.644}
                            });

                            var geocoder = new google.maps.Geocoder();

                            document.getElementById('submit').addEventListener('click', function() {
                                geocodeAddress(geocoder, map);
                            });


                        }
                        geocodeAddress.counter = 0;
                        var gmarkers = [];
                        function geocodeAddress(geocoder, resultsMap) {

                            var myForm =  document.forms["codeForm"];
                            var address = document.getElementById('address').value;
                            var partnerngo =  document.getElementById('partnerngo').value;
                            var monthsoftravel =  document.getElementById('monthsoftravel').value;
                            geocoder.geocode({'address': address}, function(results, status) {

                                if (status === google.maps.GeocoderStatus.OK) {


                                    clearContents(document.getElementById("address"));
                                    clearContents(document.getElementById("monthsoftravel"));
                                    clearContents(document.getElementById("partnerngo"));

                                    var lat = results[0].geometry.location.lat();
                                    var lng = results[0].geometry.location.lng();
                                    var locale = results[0].formatted_address;

//                                    myForm.elements["lat"].value = lat;
//                                    myForm.elements["lng"].value = lng;

                                    // create new hidden form element
                                    // <input type="hidden" name="lat[]" value="" />
                                    // <input type="hidden" name="lng[]" value="" />
                                    // <input type="hidden" name="visitedlocale[]" value="" />

                                    var latElem = document.createElement("input");
                                    latElem.setAttribute( 'type', "hidden" );
                                    latElem.setAttribute( 'name', "lat[]" );
                                    latElem.setAttribute("id", geocodeAddress.counter);

                                    latElem.value = lat;

                                    var lngElem = document.createElement("input");
                                    lngElem.setAttribute( 'type', "hidden" );
                                    lngElem.setAttribute( 'name', "lng[]" );
                                    lngElem.setAttribute("id", geocodeAddress.counter);

                                    lngElem.value = lng;

                                    var NGOElem = document.createElement("input");
                                    NGOElem.setAttribute( 'type', "hidden" );
                                    NGOElem.setAttribute( 'name', "partnerngo[]" );
                                    NGOElem.setAttribute("id", geocodeAddress.counter);

                                    NGOElem.value =  partnerngo;

                                    var MonthsElem = document.createElement("input");
                                    MonthsElem.setAttribute( 'type', "hidden" );
                                    MonthsElem.setAttribute( 'name', "monthsoftravel[]" );
                                    MonthsElem.setAttribute("id", geocodeAddress.counter);

                                    MonthsElem.value = monthsoftravel;

                                    var localeElem = document.createElement("input");
                                    localeElem.setAttribute( 'type', "hidden" );
                                    localeElem.setAttribute( 'name', "address[]" );
                                    localeElem.setAttribute("id", geocodeAddress.counter);
                                    localeElem.value = locale;

                                    // append them to the form
                                    myForm.appendChild( latElem );
                                    myForm.appendChild( lngElem );
                                    myForm.appendChild( localeElem );
                                    myForm.appendChild( NGOElem );
                                    myForm.appendChild( MonthsElem );


                                    var node = document.createElement("LI");
                                    var boldlocation = document.createElement("b");
                                    var boldmonths = document.createElement("b");
                                    var boldngo = document.createElement("b");

                                    boldlocation.appendChild(document.createTextNode("location: "));
                                    boldmonths.appendChild(document.createTextNode("months of travel: "));
                                    boldngo.appendChild(document.createTextNode("Partner NGO: "));

                                    node.setAttribute( 'class', "list-group-item" );
                                    node.setAttribute('id', geocodeAddress.counter);
                                    var breaker = document.createElement("br");
                                    var breaker1 = document.createElement("br");

                                    var textnode = document.createTextNode( results[0].formatted_address);
                                    var textnode1 = document.createTextNode(monthsoftravel);
                                    var textnode2 = document.createTextNode(partnerngo);

                                    var kill = document.createElement("a");
                                    var id =  localeElem.getAttribute("id");


                                    kill.setAttribute('class', "pull-right");

                                    kill.innerHTML="remove";
                                    kill.onclick=function() {killFunction(id)};
                                    node.appendChild(boldlocation);

                                    node.appendChild(textnode);
                                    node.appendChild(breaker);
                                    node.appendChild(boldmonths);

                                    node.appendChild(textnode1);
                                    node.appendChild(breaker1);
                                    node.appendChild(boldngo);

                                    node.appendChild(textnode2);
                                    node.appendChild(kill);
                                    document.getElementById("list").appendChild(node);
                                    geocodeAddress.counter++;
                                    resultsMap.setCenter( results[0].geometry.location );

                                    var marker = new google.maps.Marker({

                                        map: resultsMap,
                                        position: results[0].geometry.location
                                    });
                                    gmarkers.push(marker);

                                } else {

                                    alert('Geocode was not successful for the following reason: ' + status);
                                }
                            });
                        }

                        function killFunction   (id) {
                            removeElement(id);
                            removeElement(id);
                            removeElement(id);
                            removeElement(id);
                            removeElement(id);
                            removeElement(id);
                            removeMarker(id);


                        }

                        function removeMarker(id){

                            gmarkers[id].setMap(null);

                        }
                    </script>
                    <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8jxOG3dfRrm8yZ7ACXvkbB_q_Bc7DOW0&callback=initMap">
                    </script>

                    <script>
                        function removeElement(elementId) {
                            // Removes an element from the document
                            var element = document.getElementById(elementId);
                            element.parentNode.removeChild(element);
                        }
                    </script>




@stop