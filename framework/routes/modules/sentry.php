<?php

Route::get('/', ['as' => 'sentry.home', 'uses' => 'AssetsController@index']);

/* Agregar cuentas maestras */
Route::get('masters', ['as' => 'sentry.masters.index', 'uses' => 'MastersController@index']);
Route::get('masters/create', ['as' => 'sentry.masters.create', 'uses' => 'MastersController@create']);
Route::post('masters/create', ['as' => 'sentry.masters.store', 'uses' => 'MastersController@store']);
Route::get('masters/{master}/edit', ['as' => 'sentry.masters.edit', 'uses' => 'MastersController@edit']);
Route::put('masters/{master}/edit', ['as' => 'sentry.masters.update', 'uses' => 'MastersController@update']);
Route::delete('masters/{master}/destroy', ['as' => 'sentry.masters.destroy', 'uses' => 'MastersController@destroy']);
Route::get('masters/{master}/associate', ['as' => 'sentry.masters.associate', 'uses' => 'MastersController@associate']);
Route::get('masters/{master}/user/create', ['as' => 'sentry.masters.users.create', 'uses' => 'MastersController@userCreate']);
Route::post('masters/{master}/user/create', ['as' => 'sentry.masters.users.store', 'uses' => 'MastersController@userStore']);
Route::get('masters/{master}/{user}/privileges', ['as' => 'sentry.masters.users.privileges', 'uses' => 'MastersController@userSetPrivileges']);
Route::post('masters/{master}/{user}/privileges', ['as' => 'sentry.masters.users.permissions', 'uses' => 'MastersController@userSavePrivileges']);
Route::post('masters/{master}/departament/create', ['as' => 'sentry.masters.departament.store', 'uses' => 'MastersController@departamentStore']);

Route::get('configurations/{master}/create', ['as' => 'sentry.configuration.create', 'uses' => 'ConfigurationsController@create']);
Route::post('configuration/{master}/create', ['as' => 'sentry.configuration.store', 'uses' => 'ConfigurationsController@store']);
Route::put('configuration/{master}/{configuration}/edit', ['as' => 'sentry.configuration.update', 'uses' => 'ConfigurationsController@update']);

Route::bind('master', function($master, $route){
    return \Hashids::decode($master);
});

/* Modulos o aplicaciones accesibles de la suite */
Route::get('modules', ['as' => 'sentry.modules.index', 'uses' => 'ModulesController@index']);
Route::post('modules', ['as' => 'sentry.modules.store', 'uses' => 'ModulesController@store']);
Route::get('modules/{module}/edit', ['as' => 'sentry.modules.edit', 'uses' => 'ModulesController@edit']);
Route::put('modules/{module}/edit', ['as' => 'sentry.modules.update', 'uses' => 'ModulesController@update']);
Route::delete('modules/{module}/destroy', ['as' => 'sentry.modules.destroy', 'uses' => 'ModulesController@destroy']);
Route::bind('module', function($module, $route){
    return \Hashids::decode($module);
});
/* Relación cuentas maestras con modulos */
Route::get('suites/create', ['as' => 'sentry.suites.create', 'uses' => 'SuitesController@create']);
Route::post('suites/create', ['as' => 'sentry.suites.store', 'uses' => 'SuitesController@store']);
Route::get('suites/{suite}/toggle', ['as' => 'sentry.suites.toggle', 'uses' => 'SuitesController@toggle']);
Route::delete('suites/{suite}/destroy', ['as' => 'sentry.suites.destroy', 'uses' => 'SuitesController@destroy']);
Route::bind('suite', function($suite, $route){
    return \Hashids::decode($suite);
});

Route::get('tools', ['as' => 'sentry.tools.index', 'uses' => 'ToolsController@index']);
Route::get('tools/activity', ['as' => 'sentry.activities.index', 'uses' => 'ToolsController@indexActivities']);
Route::get('tools/activity/{user}', ['as' => 'sentry.activities.show', 'uses' => 'ToolsController@showActivities']);
Route::get('tools/activity/{user}/records', ['as' => 'sentry.activities.records', 'uses' => 'ToolsController@getRecords']);
Route::get('tools/analytics', ['as' => 'sentry.analytics.index', 'uses' => 'ToolsController@analytics']);
Route::get('tools/databases', ['as' => 'sentry.databases.index', 'uses' => 'ToolsController@databases']);
Route::get('tools/security', ['as' => 'sentry.security.index', 'uses' => 'ToolsController@security']);
Route::get('tools/security/authorized-users', ['as' => 'sentry.security.users', 'uses' => 'ToolsController@usersSecurity']);
Route::post('tools/security/{authorized}/authorize', ['as' => 'sentry.users.authorize', 'uses' => 'ToolsController@userAuthorize']);
Route::get('tools/privileges', ['as' => 'sentry.modules.privileges', 'uses' => 'ToolsController@privileges']);
Route::post('tools/privileges', ['as' => 'sentry.privileges.set', 'uses' => 'ToolsController@setPrivileges']);
Route::bind('authorized', function($authorized, $route){
    return \Hashids::connection('security')->decode($authorized);
});