<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'landing.index', 'uses' => 'WebController@index']);

Auth::routes();
Route::get('/home', ['as' => 'suite.platform.index', 'uses' => 'HomeController@index']);
Route::get('/companies/{id}/{idmod}', ['as' => 'companies','uses' => 'HomeController@show']);

Route::group(['middleware' => ['auth'], 'namespace' => 'Platform'], function(){
    require (__DIR__ . '/modules/platform.php');
});

Route::group(['middleware' => ['auth', 'qore'], 'prefix' => 'qore', 'namespace' => 'Qore'], function(){
    require (__DIR__ . '/modules/qore.php');
});

Route::group(['middleware' => ['auth', 'sentry'], 'prefix' => 'sentry', 'namespace' => 'Sentry'], function(){
    require (__DIR__ . '/modules/sentry.php');
});

Route::group(['middleware' => ['auth','validate', 'module'], 'prefix' => 'recove', 'namespace' => 'Recove'], function(){
    require (__DIR__ . '/modules/recove.php');
});

Route::group(['middleware' => ['auth','validate', 'module'], 'prefix' => 'anexo31', 'namespace' => 'Anexo31'], function(){
    require (__DIR__ . '/modules/anexo31.php');
});

Route::group(['middleware' => ['auth','validate', 'module'], 'prefix' => 'cove', 'namespace' => 'Cove'], function(){
    require (__DIR__ . '/modules/cove.php');
});

Route::group(['middleware' => ['auth', 'validate'], 'prefix' => 'esells', 'namespace' => 'Esells'], function(){
    require (__DIR__ . '/modules/esells.php');
});

Route::group(['middleware' => ['auth','validate', 'module'], 'prefix' => 'secenet', 'namespace' => 'Secenet'], function(){
    require (__DIR__ . '/modules/secenet.php');
});

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| Rutas utilizadas para pruebas aisladas de la funcionalidad de los
| modulos de la suite.
|
*/

/* ------------------------------------------------------------------------------------
Route::get('storage', ['as' => 'test.upload', 'uses' => 'TestController@upload']);
Route::post('storage', ['as' => 'test.storage', 'uses' => 'TestController@storage']);
Route::get('mail-template', ['as' => 'test.template', 'uses' => 'TestController@template']);
Route::get('need-database/{id}', ['as' => 'test.needdatabase', 'uses' => 'TestController@dbContract']);
Route::get('active-or-create/{suite}', ['as' => 'test.activeorcreate', 'uses' => 'TestController@testSuite']);
Route::get('execute-script/{id}', ['as' => 'test.executescript', 'uses' => 'TestController@executeScript']);
Route::get('automatically-invoices', ['as' => 'test.automatically', 'uses' => 'TestController@generateInvoice']);

Route::get('hash', function(){
	return dd(\Hashids::connection('security')->encode(1));
});
------------------------------------------------------------------------------------ */