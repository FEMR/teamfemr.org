@extends('layouts.appFemr')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>Discussion Board</h1></center></div>

                    <div class="panel-body">
                        <iframe id="forum_embed"
                                src="javascript:void(0)"
                                scrolling="no"
                                frameborder="0"
                                width="900"
                                height="700">
                        </iframe>

                        <script type="text/javascript">
                            document.getElementById("forum_embed").src =
                                    "https://groups.google.com/forum/embed/?place=forum/femr" +
                                    "&showsearch=true&showpopout=true&parenturl=" +
                                    encodeURIComponent(window.location.href);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection