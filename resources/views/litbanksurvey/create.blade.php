@extends('layouts.app')

//Literature Bank survey page
@section('content')
    <div class = "container">

        <h1>Add Literature Resource</h1>

        //url for the Literature Bank survey
        {!! Form::open(['url' => 'litbanksurvey']) !!}

        //Use a form to get the variables from the Literature Bank survey
        {!! Form::label('contributorName', 'Contributor Name:') !!}
        {!! Form::text('contributorName' , null, ['class' => 'form-control']) !!}


        {!! Form::label('authorName', 'Author Name:') !!}
        {!! Form::text( 'authorName' , null, ['class' => 'form-control']) !!}


        {!! Form::label('addLink', 'Add Link to Resource:') !!}
        {!! Form::text( 'addLink' , null, ['class' => 'form-control']) !!}

<h1>OR</h1>

        //Option to upload a file
        <div class="about-section">
            <div class="text-content">
                <div class="span7 offset1">
                    @if(Session::has('success'))
                        <div class="alert-box success">
                            <h2>{!! Session::get('success') !!}</h2>
                        </div>
                    @endif

                    //User prompt to upload a file
                    <div class="secure">Upload file</div>
                    {!! Form::open(array('url'=>'apply/upload','method'=>'POST', 'files'=>true)) !!}
                    <div class="control-group">
                        <div class="controls">
                            {!! Form::file('image') !!}

                            //Error check
                            <p class="errors">{!!$errors->first('image')!!}</p>
                            @if(Session::has('error'))
                                <p class="errors">{!! Session::get('error') !!}</p>
                            @endif
                        </div>
                    </div>
                    <div id="success"> </div>
                </div>
            </div>
        </div>

        //Submit and close form
        {!! Form::submit('Add Resource', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}

    </div>
@endsection
