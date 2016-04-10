@extends('layouts.appFemr')

<!-Literature Bank survey page-->
@section('content')
    <div class = "container">
        <h1>Add Literature Resource</h1>

        <!--url for the Literature Bank survey-->
        {{--{!! Form::open(['url' => 'litbanksurvey']) !!}--}}
        {!! Form::open([ 'enctype' => 'multipart/form-data', 'method' => 'POST', 'action' => 'LiteratureBankSurveyController@store', 'id' => 'upload' ]) !!}

        <!--Use a form to get the variables from the Literature Bank survey-->
        {!! Form::label('contributorName', 'Contributor Name:') !!}
        {!! Form::text('contributorName' , null, ['class' => 'form-control']) !!}


        {!! Form::label('authorName', 'Author Name:') !!}
        {!! Form::text( 'authorName' , null, ['class' => 'form-control']) !!}

        {!! Form::label('addLink', 'Add Link to Resource:') !!}
        {!! Form::url( 'addLink' , null, ['class' => 'form-control']) !!}
<br>
        <input type="file" name="file"><br />

        <!--Submit and close form-->
        {!! Form::submit('Add Resource', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}




        <div id="message"></div>

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

    </div>
@endsection
