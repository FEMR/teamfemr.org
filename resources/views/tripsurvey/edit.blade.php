@extends('layouts.appFemr')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><center><h1>Edit this Survey</h1></center></div>
                 <div class="panel-body">


                            <form method="POST" action="/surveys/{{$survey->id}}">

                                {{method_field('PATCH')}}
                                {{csrf_field()}}


                                <div class="form-group">
                                    <label for="teamname">Team Name:</label>
                                    <textarea name="teamname" class="form-control">{{$survey->teamname}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="initiated">Initiated:</label>
                                    <textarea name="initiated" class="form-control">{{$survey->initiated}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="totalmatriculants">Total Matriculants:</label>
                                    <textarea name="totalmatriculants" class="form-control">{{$survey->totalmatriculants}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="medschoolterms">Medical School Terms:</label>
                                    <textarea name="medschoolterms" class="form-control">{{$survey->medschoolterms}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="aidingschools">Aiding Schools:</label>
                                    <textarea name="aidingschools" class="form-control">{{$survey->aidingschools}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="totalperyear">Total students per year:</label>
                                    <textarea name="totalperyear" class="form-control">{{$survey->totalperyear}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label for="monthsoftravel">Months of travel:</label>
                                    <textarea name="monthsoftravel" class="form-control">{{$survey->monthsoftravel}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="partnerngo">Partner NGO:</label>
                                    <textarea name="partnerngo" class="form-control">{{$survey->partnerngo}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="faculty">Faculty:</label>
                                    <textarea name="faculty" class="form-control">{{$survey->faculty}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="appprocess">Application process:</label>
                                    <textarea name="appprocess" class="form-control">{{$survey->appprocess}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="programelements">Program Elements:</label>
                                    <textarea name="programelements" class="form-control">{{$survey->programelements}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="finsupport">Financial Support:</label>
                                    <textarea name="finsupport" class="form-control">{{$survey->finsupport}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="facultytimeallotted">Faculty Time Allotted:</label>
                                    <textarea name="facultytimeallotted" class="form-control">{{$survey->facultytimeallotted}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="adminsupport">Administrative Support:</label>
                                    <textarea name="adminsupport" class="form-control">{{$survey->adminsupport}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="contactinfo">Contact Info:</label>
                                    <textarea name="contactinfo" class="form-control">{{$survey->contactinfo    }}</textarea>
                                </div>

                                <input class="btn btn-primary form-control" type="submit" value="Submit">


                            </form>

                 </div>
                </div>
            </div>
        </div>
    </div>






@stop