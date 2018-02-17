<?php

Route::get('/', ['as' => 'anexo31.home', 'uses' => 'HomeController@index']);
Route::get('/certification', ['as' => 'anexo31.certification.index', 'uses' => 'CertificationController@index']);
Route::put('/certification/{id}', ['as' => 'anexo31.certification.update', 'uses' => 'CertificationController@update']);
Route::get('/upload', ['as' => 'anexo31.upload.index', 'uses' => 'UploadController@index']);
Route::post('/datastage', ['as' => 'anexo31.datastage.store', 'uses' => 'DataStageController@store']);
Route::post('/inventory', ['as' => 'anexo31.inventory.store', 'uses' => 'InventoryController@store']);
Route::post('/discharge', ['as' => 'anexo31.discharge.store', 'uses' => 'DischargeController@store']);
Route::post('/discharge/check', ['as' => 'anexo31.discharge.check', 'uses' => 'DischargeController@check']);
Route::get('/simulator', ['as' => 'anexo31.simulator.index', 'uses' => 'SimulatorController@index']);
Route::post('/simulator', ['as' => 'anexo31.simulator.store', 'uses' => 'SimulatorController@store']);
Route::get('/reports', ['as' => 'anexo31.reports.index', 'uses' => 'ReportController@index']);
Route::post('/graphs', ['as' => 'anexo31.reportes.graph', 'uses' => 'ReportController@graph']);