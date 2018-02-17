<?php 

Route::get('/', ['as' => 'esells.home', 'uses' => 'HomeController@index']);

Route::get('companies', ['as' => 'esells.companies.index', 'uses' => 'CompaniesController@index']);