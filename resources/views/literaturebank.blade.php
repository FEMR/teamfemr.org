@extends('layouts.appFemr')

@section('content')

<!--This page is the display for the Literature Bank page-->

<!--Use bootstrap to integrate the web page, so that it looks similar to the other web pages-->
<div class="panel-heading"><center><h1>Literature Bank</h1></center></div>
    <div class="panel-body">
        <!--Link to Literature Bank Survey-->
        <div><a href ="/litbanksurvey/create" class="btn btn-danger btn-sm">ADD RESOURCE</a>
            <hr>
        </div>
            <!--Portion of web page where the links to resources are listed-->

              <!--Formatting of page-->
        <h3>Articles:</h3>
        <!-- <div class="row"> -->

            <!--Loop through the approved literature articles and format them so that only three literature article cards appear on one line-->
            <div class="row">
            @foreach($literatures as $id => $literature)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!--Pull the titles of web pages and display them-->
                            <a href= {{$literature->url}}> {{$literature->title}}</a>
                        </div>
                        <div class="panel-body">{{$literature->description}}<br>
                            <!--Display scraped image-->
                            <a class="img-responsive center-block" href={{$literature->url}}>
                            <img src= {{$literature->imageUrl}} alt="Mainimage" style="width:200px;height:150px;"></a>
                            <br>
                            <!--Display file from file upload-->
                            @if($literature->fileName)
                            <h4><a href= {{$literature->fileName}}>Download Related Content</a></h4>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<!--</div>-->


@endsection

