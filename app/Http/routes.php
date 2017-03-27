<?php

Auth::routes();









// TODO -- not sure if this is needed, but if so definitely move out of the routes file
//Convert database entries to xml form
//Route::get('/users/xml', function() {
//
//
//
//	$surveys = Survey::where('approved', '=', 1)
//		->with( 'trips' )
//		->get();
//
//	$xml = new XMLWriter();
//	$xml->openMemory();
//	$xml->startDocument();
//	$xml->startElement('markers');
//	foreach($surveys as $id => $survey) {
//		foreach($survey->trips as  $trip){
//			$xml->startElement('marker');
//			$xml->writeAttribute('lat', $trip->place->lat);
//			$xml->writeAttribute('lng', $trip->place->lng);
//			foreach($trip->place->trips as $idz => $placetrip){
//				$xml->writeAttribute('id' . $idz, $placetrip->survey->id);
//				$xml->writeAttribute('teamname' . $idz, $placetrip->survey->teamname);
//			}
//			$xml->endElement();
//
//		}
//
//
//
//
//
//
//
//	}
//	$xml->endElement();
//	$xml->endDocument();
//
//	$content = $xml->outputMemory();
//	$xml = null;
//
//	return response($content)->header('Content-Type', 'text/xml');
//});


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


Route::group(['middleware' => 'web'], function ()
{

	Route::group(['namespace' => 'Admin'], function () {
		// Controllers Within The "App\Http\Controllers\Admin" Namespace
	});


	Route::get( '/',      'PageController@home'      )->name( 'pages.home'  );
	Route::get( '/emr',   'PageController@emr'       )->name( 'pages.emr'   );
	Route::get( '/news',  'PageController@news'      )->name( 'pages.news'  );
	Route::get( '/slack', 'PageController@slack'     )->name( 'pages.slack' );
	
	//Calls the Trip Database controller, which controls the Trip Database web page
	Route::get('tripdatabase', 'TripDatabaseController@index');

	//Calls the Literature Bank controller, which controls the Literature Bank web page
	Route::get('literaturebank', 'LiteratureBankController@index');

	//sends emails
	Route::get('/emails', 'EmailController@index');
	Route::get('/emails/test', 'EmailController@index');
	Route::get('/emails/test2', 'EmailController@index2');
	Route::get('/emails/test3', 'EmailController@index3');

	Route::get('/confirmations/surveymsg', 'ConfirmationMsgController@index');

	Route::get('/confirmations/literaturemsg', 'ConfirmationMsgController@literature');



	//Pulls the authorization page
	Route::auth();

//	all pages inside this group must be logged in to use
	Route::group([ 'middleware' => 'auth' ], function () {
		Route::get('/home', 'HomeController@index');
//		Route::get('/home/{user}', 'HomeController@test');

		//Call appropriate controllers (which control the Trip Survey web page and survey)
		Route::get('/tripsurvey', 'TripSurveyController@index');
		Route::get('/tripsurvey/create', 'TripSurveyController@create');
		Route::post('/tripsurvey', 'TripSurveyController@store');





		//	Calls the literature bank web page and create function
		Route::get('/litbanksurvey', 'LiteratureBankSurveyController@index');
		Route::get('/litbanksurvey/create', 'LiteratureBankSurveyController@create');
		Route::post('/litbanksurvey', 'LiteratureBankSurveyController@store');
		Route::get('/litbanksurvey/{id}', 'LiteratureBankSurveyController@show');
	});
	Route::get('/tripsurvey/{id}', 'TripSurveyController@show');
	Route::get('/allprograms', 'TripDatabaseController@show');
	
	//Moderator Pages
	Route::group([ 'middleware' => 'moderator' ], function ()
	{

		Route::get('surveys/{survey}/edit', 'TripSurveyController@edit');
		Route::patch('surveys/{survey}', 'TripSurveyController@update');
		//	gets the approvals.edit page
		Route::get('/approvals/edit','ApprovalsController@edit');
		//	stores the updated information
		Route::patch('/approvals/edit', 'ApprovalsController@update');

		Route::get('/deletes','ApprovalsController@viewDeletes');
		Route::get('/deleteArticles','LitApprovalsController@viewDeletes');

		//approvals for the literature articles
		Route::get('/approvals/lit_approvals','LitApprovalsController@edit');
		//	stores the updated information
		Route::patch('/approvals/lit_approvals', 'LitApprovalsController@update');

		//approvals for the moderators
		Route::get('/approvals/mod_approvals','ModApprovalsController@edit');
		//	stores the updated information
		Route::patch('/approvals/mod_approvals', 'ModApprovalsController@update');

		Route::get('/approvals/surveyedits', 'SurveyEditsController@index');
	});

	//Call the upload function
	Route::get('upload', function() {
		return View::make('pages.upload');
	});
	Route::post('apply/upload', 'LiteratureBankController@upload');
});







