@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><center><h1>Literature Bank</h1></center></div>

                    <!--Link to Literature Bank Survey-->
                    <h2><a href="litbanksurvey/create">Click here to add a resource</a></h2>

                </div>

                                <!--Portion of web page where the links to resources are listed-->
                <h3>New Additions:</h3>
                @foreach($literatures as $literature)
                        <h4><a href = {{$literature->addLink}}>{{ $literature->addLink}}</a> </h4>
                @endforeach
            </div>
         </div>
     </div>
</div>

@endsection

