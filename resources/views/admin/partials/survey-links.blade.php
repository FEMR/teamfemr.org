@foreach($outreachPrograms as $program)
<a href="{{ route('FieldController@show', [ 'outreach-program', $program->id ]) }}">{{  $program->id }}</a><br />
@endforeach