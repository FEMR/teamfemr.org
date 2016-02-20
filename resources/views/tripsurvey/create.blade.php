@extends('layouts.app')


@section('content')
    <div class = "container">
    <h1> write survey</h1>

    {!! Form::open(['url' => 'tripsurvey']) !!}

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


        {!! Form::label('visitedlocale', 'Locations visited:') !!}

        {!! Form::text( 'visitedlocale' , null, ['class' => 'form-control']) !!}


        {!! Form::label('monthsoftravel', 'month(s) of travel:') !!}

        {!! Form::text( 'monthsoftravel' , null, ['class' => 'form-control']) !!}


        {!! Form::label('partnerngo', 'NGO/Parter organizations:') !!}

        {!! Form::text( 'partnerngo' , null, ['class' => 'form-control']) !!}


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


    {!! Form::submit('Add Article', ['class' => 'btn btn-primary form-control']) !!}

    {!! Form::close() !!}

    </div>
@endsection
