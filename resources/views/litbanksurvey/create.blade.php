@extends('layouts.app')

<!-Literature Bank survey page-->
@section('content')
    <div class = "container">

        <h1>Add Literature Resource</h1>

        <!--url for the Literature Bank survey-->
        {{--{!! Form::open(['url' => 'litbanksurvey']) !!}--}}
        {!! Form::open([ 'method' => 'POST', 'action' => 'LiteratureBankSurveyController@store', 'id' => 'codeForm' ]) !!}

        <!--Use a form to get the variables from the Literature Bank survey-->
        {!! Form::label('contributorName', 'Contributor Name:') !!}
        {!! Form::text('contributorName' , null, ['class' => 'form-control']) !!}


        {!! Form::label('authorName', 'Author Name:') !!}
        {!! Form::text( 'authorName' , null, ['class' => 'form-control']) !!}


        {!! Form::label('addLink', 'Add Link to Resource:') !!}
        {!! Form::url( 'addLink' , null, ['class' => 'form-control']) !!}


        {!! Form::file('image') !!}


        <!--Submit and close form-->
        {!! Form::submit('Add Resource', ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}

    </div>
@endsection
