@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                        <div class="panel-heading"><center><h1>Write Survey</h1></center></div>
                    <div class="panel-body">
        <!--Print to web page-->


            <div class="col-sm-6">
{{--This did not work, tried to get approval message displayed on the form RD --}}
                {{--@if(Session::has('flash_message'))--}}
                    {{--<div class="alert alert-success">--}}
                        {{--{{ Session::get('flash_message') }}--}}
                    {{--</div>--}}
                {{--@endif--}}
{{--*********************************************************--}}
{{--This displays an error message if required fields are left blank - RD--}}
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {!! Form::open(['url' => 'tripsurvey']) !!}

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


        {!! Form::label('visitedlocale', 'Locations visited:') !!}
        {!! Form::text( 'visitedlocale' , null, ['class' => 'form-control']) !!}


        {!! Form::label('lat', 'Latitude:') !!}
        {!! Form::number( 'lat' , null, ['class' => 'form-control']) !!}


        {!! Form::label('lng', 'Longitude:') !!}
        {!! Form::number('lng' , null, ['class' => 'form-control']) !!}


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

<!--Submit and close form-->
    {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}

    {!! Form::close() !!}
            {{--</label>--}}

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
