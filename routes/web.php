<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/test', function () {
	$data =  App\Models\Auditoire::getBilan();
    return view('test');
});


Route::prefix('comptabilite')->group(function(){
	Route::name('comptabilite.')->group(function () {
		Route::get('/','Comptabilite\DashboardController@index')->name('index');
		Route::get('/auditoire/{auditoire}','Comptabilite\DashboardController@getListStudent')->name('getListStudent');
		
		Route::get('/autorise/{etudiant}','Comptabilite\DashboardController@autoriseStudent')->name('autoriseStudent');
		Route::post('/createEtudiant','Comptabilite\DashboardController@createEtudiant')->name('createEtudiant');
		Route::get('/createEtudiant',function(){return redirect()->back();});
		Route::post('/updateEtudiant','Comptabilite\DashboardController@updateEtudiant')->name('updateEtudiant');
		Route::get('/updateEtudiant',function(){return redirect()->back();});

	});
});
Route::prefix('section')->group(function(){
	Route::name('section.')->group(function () {
		Route::get('/','Section\DashboardController@index')->name('index');
		Route::get('/liste-auditoires','Section\DashboardController@getlistAuditoires')->name('getListAuditoires');
		Route::get('/auditoire/{auditoire}','Section\DashboardController@getListStudent')->name('getListStudent');
		
		Route::get('/enrolerEtudiant/{etudiant}','Section\DashboardController@enrolerEtudiant')->name('enrolerEtudiant');
		Route::get('/destroyEnrolement/{enrole}','Section\DashboardController@destroyEnrolement')->name('!enrolerEtudiant');
		Route::get('enroles/auditoire/{auditoire}','Section\DashboardController@getListStudentEnroler')->name('getListStudentEnroles');
		Route::get('bilan','Section\DashboardController@getBilan')->name('getBilan');
		// Route::post('/createEtudiant','Section\DashboardController@createEtudiant')->name('createEtudiant');
		// Route::get('/createEtudiant',function(){return redirect()->back();});
		// Route::post('/updateEtudiant','Section\DashboardController@updateEtudiant')->name('updateEtudiant');
		// Route::get('/updateEtudiant',function(){return redirect()->back();});

	});
});
Auth::routes();

Route::get('/home',function(){
	return App\Http\Controllers\Helper::redirectToDashboard();
})->name('home');
