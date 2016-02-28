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

//Calls the Trip Database controller, which controls the Trip Database web page
Route::get('tripdatabase', 'TripDatabaseController@index');

//Calls the Literature Bank controller, which controls the Literature Bank web page
Route::get('literaturebank', 'LiteratureBankController@index');

Route::get('hello/{name}', function ($name){
	echo 'Hello There ' . $name;
});
//Create an item
Route::get('test', function() {
	echo 'POST';
});

//Convert database entries to xml form
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

//Call appropriate controllers (which control the Trip Survey web page and survey)
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

	//Call appropriate controllers (which control the Literature Bank web page and survey)
	Route::group(['middleware' => 'web'], function () {
		Route::get('/litbanksurvey', 'LiteratureBankSurveyController@index');
		Route::get('/litbanksurvey/create', 'LiteratureBankSurveyController@create');
		Route::post('/litbanksurvey', 'LiteratureBankSurveyController@store');
		Route::get('/litbanksurvey/{id}', 'LiteratureBankSurveyController@show');

		Route::auth();

		Route::group(['middleware' => 'auth'], function () {
			Route::get('/home', 'HomeController@index');
			Route::get('/home/{user}', 'HomeController@test');

		});
	});

	//Call the upload function
	Route::get('upload', function() {
		return View::make('pages.upload');
	});
	Route::post('apply/upload', 'LiteratureBankController@upload');
});

