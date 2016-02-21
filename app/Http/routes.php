<?php
use App\Survey;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //echo 'Welcome to my site';
    return view('welcome');
});

Route::get('tripdatabase', 'TripDatabaseController@index');

Route::get('literaturebank', 'literaturebankController@index');

Route::get('discussionboard', 'discussionboardController@index');

Route::get('hello/{name}', function ($name){
	echo 'Hello There ' . $name;
});
//Create an item
Route::get('test', function() {
	echo 'POST';
});

Route::get('/users/xml', function() {
	$surveys = Survey::all();


	$xml = new XMLWriter();
	$xml->openMemory();
	$xml->startDocument();
	$xml->startElement('markers');
	foreach($surveys as $survey) {
		$xml->startElement('marker');
		$xml->writeAttribute('id', $survey->id);
		$xml->writeAttribute('teamname', $survey->teamname);
		$xml->writeAttribute('lat', $survey->lat);
		$xml->writeAttribute('lng', $survey->lng);
		$xml->endElement();
	}
	$xml->endElement();
	$xml->endDocument();

	$content = $xml->outputMemory();
	$xml = null;

	return response($content)->header('Content-Type', 'text/xml');
});

//Read an item
Route::get('test', function(){
	echo '<form method = "POST" action="test">';
	echo '<input type="submit">';
	echo '<input type="hidden" value="DELETE" name="_method">';
	echo '<form>';

});

//Delete an item
Route::delete('test', function(){
	echo 'DELETE';
});




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
	Route::get('/tripsurvey', 'TripSurveyController@index');
	Route::get('/tripsurvey/create', 'TripSurveyController@create');
	Route::post('/tripsurvey', 'TripSurveyController@store');
	Route::get('/tripsurvey/{id}', 'TripSurveyController@show');

    Route::auth();

	Route::group([ 'middleware' => 'auth' ], function ()
	{
		Route::get('/home', 'HomeController@index');
		Route::get('/home/{user}', 'HomeController@test');

	});
});
