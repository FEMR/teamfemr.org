@extends('layouts.appFemr')


@section('content')

                        <div class="panel-heading"><center><h1>Write Survey</h1>
                            <p>Please fill out every box, if not applicable put NA.</p></center>
                        </div>
                    <div class="panel-body">
        <!--Print to web page-->



{{--This displays an error message if required fields are left blank - RD--}}
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif


        {!! Form::open([ 'method' => 'POST', 'action' => 'TripSurveyController@store', 'id' => 'codeForm' ]) !!}

<div class ="row">
    <div class="col-sm-6">




                    <!--Use a form to get the variables from the Literature Bank survey-->
        {!! Form::label('teamname', 'Program Name:') !!}
        {!! Form::text('teamname' , null, ['class' => 'form-control']) !!}


        {!! Form::label('initiated', 'Initiated:') !!}
        {!! Form::input('year', 'initiated' , date('Y'), ['class' => 'form-control']) !!}


        {!! Form::label('totalmatriculants', 'total matriculants:') !!}
        {!! Form::text( 'totalmatriculants' , null, ['class' => 'form-control']) !!}

        {!! Form::label('medschoolterms', 'Medical school student class involvement (M1, M2, M3, M4):') !!}
        {!! Form::text( 'medschoolterms' , null, ['class' => 'form-control']) !!}




        {!! Form::label('aidingschools', 'other participating professional schools:') !!}
        {!! Form::text( 'aidingschools' , null, ['class' => 'form-control']) !!}



        {!! Form::label('totalperyear', 'total participants in global health outreach per year:') !!}
        {!! Form::text( 'totalperyear' , null, ['class' => 'form-control']) !!}



        {!! Form::label('faculty', 'Faculty and staffing:') !!}
        {!! Form::text( 'faculty' , null, ['class' => 'form-control']) !!}


        {!! Form::label('appprocess', 'application process:') !!}
        {!! Form::text( 'appprocess' , null, ['class' => 'form-control']) !!}



        {!! Form::label('programelements', 'program elements:') !!}
        {!! Form::text( 'programelements' , null, ['class' => 'form-control']) !!}



        {!! Form::label('finsupport', 'financial support:') !!}
        {!! Form::text( 'finsupport' , null, ['class' => 'form-control']) !!}



        {!! Form::label('facultytimeallotted', 'faculty time allotted:') !!}
        {!! Form::text( 'facultytimeallotted' , null, ['class' => 'form-control']) !!}


        {!! Form::label('adminsupport', 'administrative support:') !!}
        {!! Form::text( 'adminsupport' , null, ['class' => 'form-control']) !!}



        {!! Form::label('contactinfo', 'contact info:') !!}
        {!! Form::text( 'contactinfo' , null, ['class' => 'form-control']) !!}
        <br>


    </div>
        <div class="col-sm-6">


    {{--//Adding Cities--}}
                    <br>
        <div id="map" style="width: 420px; height: 300px"></div>

        <h1>Add Trip</h1>


                    <div class="form-group">
                        <label for="address">Visited City:</label>
                        <input class="form-control" name="address" type="text" id="address">

                        <label for="monthsoftravel">Months of Travel:</label>
                        <input class="form-control" name="monthsoftravel" type="text" id="monthsoftravel">

                        <label for="partnerngo">Partner NGO:</label>
                        <input class="form-control" name="partnerngo" type="text" id="partnerngo">



                        <input id="submit" type="button" value="Add Trip">

                    </div>

                    <ul class="list-group" id="list">

                    </ul>

</div>
                    <!--Submit and close form-->
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}


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

                        function killFunction(id) {
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

                    function clearContents(element) {
                        element.value = '';
                    }
                </script>


    {{--{!! Form::close() !!}--}}
            </form>


                        </div>
                    </div>

@endsection
