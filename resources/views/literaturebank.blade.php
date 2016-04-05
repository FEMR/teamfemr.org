@extends('layouts.appFemr')

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

            @foreach( $literatures as $id => $literature )

             <div class="boxed">
             <a href="<?php echo $info[$id]->url ?>"><?php echo $info[$id]->title ?></a>
             <br>
             <?php echo $info[$id]->description ?>
             <br>
             <a href="<?php echo $info[$id]->url ?>"><img src="<?php echo $info[$id]->image ?>" alt="Main image" style="width:200px;height:150px;"></a>
             <br>
             <?php echo $info[$id]->publishedDate ?>
             </div>

             @endforeach

                </div>


            </div>
         </div>
     </div>
</div>

@endsection

