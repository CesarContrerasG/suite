<?php
    Route::get('seals', ['as' => 'recove.seals.index', 'uses' => 'SealController@index']);
    Route::post('seals', ['as' => 'recove.seals.store', 'uses' => 'SealController@store']);
    Route::put('seals/{seal}/edit', ['as' => 'recove.seals.update', 'uses' => 'SealController@update']);
    Route::delete('seals/{seal}/destroy', ['uses' => 'SealController@destroy']);

    Route::get('agents', ['as' => 'recove.agents.index', 'uses' => 'AgentController@index']);
    Route::post('agents/export', ['as' => 'recove.agents.store', 'uses' => 'AgentController@store']);
    Route::post('aduanas', ['as' => 'recove.aduana.store', 'uses' => 'AduanaController@store']);
    Route::get('administration', ['as' => 'recove.admin.index', 'uses' => 'AdminController@index']);
    Route::get('coves/{id}', ['as' => 'recove.cove.show', 'uses' => 'CoveController@show']);
    Route::get('document/{id}', ['as' => 'recove.document.show', 'uses' => 'DocumentController@show']);
    Route::get('document-export', ['as' => 'recove.document.export', 'uses' => 'DocumentController@export']);
    Route::get('process', ['as' => 'recove.process.index', 'uses' => 'RecoveController@index']);
    Route::post('process', ['as' => 'recove.process.store', 'uses' => 'HomeController@store']);
    Route::get('recover', ['as' => 'recove.store','uses' => 'RecoveController@store']);
    Route::get('download', ['as' => 'recove.download.index', 'uses' => 'PathController@index']);
    Route::post('download', ['as' => 'recove.download.store', 'uses' => 'PathController@store']);
    Route::put('download/{path}', ['as' => 'recove.download.update', 'uses' => 'PathController@update']);
    Route::get('download/{ed}/{referen}/{id}', ['as' => 'recove.cove.download','uses' => 'CoveController@download']);
    Route::get('download/{referen}/{ed}', ['as' => 'recove.ed.download', 'uses' => 'DocumentController@download']);
    Route::get('export', ['as' => 'recove.export','uses' => 'RecoveController@export']);
    Route::get('descargar', ['uses' => 'RecoveController@download']);
    Route::get('bitacora', ['as' => 'recove.bitacora', 'uses' => 'HomeController@export']);
    Route::get('/{id}', ['as' => 'recove.home', 'uses' => 'HomeController@index']);
    