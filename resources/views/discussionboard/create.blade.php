@extends('layouts.appFemr')

<!-Literature Bank survey page-->
@section('content')
    <div class="panel-heading"><center><h1>Add DB Resource</h1>
        </center>
    </div>
    <div class="panel-body">


        <!--url for the Literature Bank survey-->
        {!! Form::open([ 'enctype' => 'multipart/form-data', 'method' => 'POST', 'action' => 'LiteratureBankSurveyController@store', 'id' => 'upload' ]) !!}

                <!--Use a form to get the variables from the Literature Bank survey. Variables include: contributor name, author name, link-->
        {!! Form::label('contributorName', 'Contributor Name:') !!}
        {!! Form::text('contributorName' , null, ['class' => 'form-control', 'placeholder'=>'type contributor name here']) !!}


        {!! Form::label('authorName', 'Author Name:') !!}
        {!! Form::text( 'authorName' , null, ['class' => 'form-control', 'placeholder'=>'type author here']) !!}

        {!! Form::label('addLink', 'Add Link to Resource:') !!}
        {!! Form::url( 'addLink' , null, ['class' => 'form-control', 'placeholder'=>'type location of site here']) !!}
        <br>
        <!--Allows user to upload a file to survey, all file types work-->
        <input type="file" name="file"><br />

        <!--Submit and close form-->
        {!! Form::submit('Add Resource', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}




        <div id="message"></div>

        <!--File upload portion of survey-->
        <script>
            var form = document.getElementById('upload');
            var request = new XMLHttpRequest();

            form.addEventListener('submit', function(e){
                e.preventDefault();
                var formdata = new FormData(form);

                request.open('post', '/upload');
                request.addEventListener("load", transferComplete);
                request.send(formdata);
            });

            function transferComplete(data){
                response JSON.parse(data.currentTarget.response);
                if(response.success)
                {
                    document.getElementById('message').innerHTML = "Successfully Uploaded Files!";
                }
            }
        </script>


@endsection