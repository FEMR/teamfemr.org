@extends('layouts.app')


@section('content')
    <div class = "container">
        <h1>Add Literature Resource</h1>

        {!! Form::open(['url' => 'litbanksurvey']) !!}

        {!! Form::label('contributorName', 'Contributor Name:') !!}

        {!! Form::text('contributorName' , null, ['class' => 'form-control']) !!}


        {!! Form::label('authorName', 'Author Name:') !!}

        {!! Form::text( 'authorName' , null, ['class' => 'form-control']) !!}


        {!! Form::label('addLink', 'Add Link') !!}

        {!! Form::text( 'addLink' , null, ['class' => 'form-control']) !!}


        {!! Form::submit('Add Article', ['class' => 'btn btn-primary form-control']) !!}

        {!! Form::close() !!}

    </div>
@endsection
