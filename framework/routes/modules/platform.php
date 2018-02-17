<?php

Route::get('profile', ['as' => 'platform.profile.index', 'uses' => 'UsersController@profile']);
Route::get('/users', ['as' => 'platform.users.index', 'uses' => 'UsersController@indexUsers']);
Route::get('/users/create', ['as' => 'platform.users.create', 'uses' => 'UsersController@createUser']);
Route::post('/users/create', ['as' => 'platform.users.store', 'uses' => 'UsersController@storeUser']);
Route::get('/client/create', ['as' => 'platform.client.create', 'uses' => 'UsersController@createClient']);
Route::get('/users/{user}/edit', ['as' => 'platform.users.edit', 'uses' => 'UsersController@editUser']);
Route::put('/users/{user}/edit', ['as' => 'platform.users.update', 'uses' => 'UsersController@updateUser']);
Route::delete('/users/{user}/destroy', ['as' => 'platform.users.destroy', 'uses' => 'UsersController@destroyUser']);

Route::get('associate-application/{user}', ['as' => 'platform.applications.config', 'uses' => 'UsersController@userPermissions']);
Route::post('associate-application/{user}', ['as' => 'platform.applications.associate', 'uses' => 'UsersController@userPrivileges']);

Route::get('/configuration', ['as' => 'configuration.edit', 'uses' => 'ToolsController@parameters']);
Route::post('/configuration', ['as' => 'configuration.store', 'uses' => 'ToolsController@configuration']);

Route::get('/notifications', ['as' => 'platform.notifications.index', 'uses' => 'ToolsController@notifications']);
Route::get('/notifications/create', ['as' => 'platform.notifications.create', 'uses' => 'ToolsController@createNotification']);
Route::post('/notifications/create', ['as' => 'platform.notifications.store', 'uses' => 'ToolsController@storeNotification']);
Route::get('/notifications/{notification}/edit', ['as' => 'platform.notifications.edit', 'uses' => 'ToolsController@editNotification']);
Route::put('/notifications/{notification}/edit', ['as' => 'platform.notifications.update', 'uses' => 'ToolsController@updateNotification']);
Route::delete('/notifications/{notification}/destroy', ['as' => 'platform.notifications.destroy', 'uses' => 'ToolsController@deleteNotification']);

Route::get('catalogs', ['as' => 'platform.catalogs.index', 'uses' => 'CatalogController@catalogs']);
Route::get('catalogs/oficials/apendice-01', ['as' => 'platform.catalog.oficial.apendice-01', 'uses' => 'CatalogController@appendixOne']);
Route::get('catalogs/oficials/apendice-02', ['as' => 'platform.catalog.oficial.apendice-02', 'uses' => 'CatalogController@appendixTwo']);
Route::get('catalogs/oficials/apendice-03', ['as' => 'platform.catalog.oficial.apendice-03', 'uses' => 'CatalogController@appendixThree']);
Route::get('catalogs/oficials/apendice-04', ['as' => 'platform.catalog.oficial.apendice-04', 'uses' => 'CatalogController@appendixFour']);
Route::get('catalogs/oficials/apendice-05', ['as' => 'platform.catalog.oficial.apendice-05', 'uses' => 'CatalogController@appendixFive']);
Route::get('catalogs/oficials/apendice-06', ['as' => 'platform.catalog.oficial.apendice-06', 'uses' => 'CatalogController@appendixSix']);
Route::get('catalogs/oficials/apendice-07', ['as' => 'platform.catalog.oficial.apendice-07', 'uses' => 'CatalogController@appendixSeven']);
Route::get('catalogs/oficials/apendice-08', ['as' => 'platform.catalog.oficial.apendice-08', 'uses' => 'CatalogController@appendixEight']);
Route::get('catalogs/oficials/apendice-09', ['as' => 'platform.catalog.oficial.apendice-09', 'uses' => 'CatalogController@appendixNine']);
Route::get('catalogs/oficials/apendice-10', ['as' => 'platform.catalog.oficial.apendice-10', 'uses' => 'CatalogController@appendixTen']);
Route::get('catalogs/oficials/apendice-11', ['as' => 'platform.catalog.oficial.apendice-11', 'uses' => 'CatalogController@appendixEleven']);
Route::get('catalogs/oficials/apendice-12', ['as' => 'platform.catalog.oficial.apendice-12', 'uses' => 'CatalogController@appendixTwelve']);
Route::get('catalogs/oficials/apendice-13', ['as' => 'platform.catalog.oficial.apendice-13', 'uses' => 'CatalogController@appendixThirteen']);
Route::get('catalogs/oficials/apendice-14', ['as' => 'platform.catalog.oficial.apendice-14', 'uses' => 'CatalogController@appendixFourteen']);
Route::get('catalogs/oficials/apendice-15', ['as' => 'platform.catalog.oficial.apendice-15', 'uses' => 'CatalogController@appendixFifteen']);
Route::get('catalogs/oficials/apendice-16', ['as' => 'platform.catalog.oficial.apendice-16', 'uses' => 'CatalogController@appendixSixteen']);
Route::get('catalogs/oficials/apendice-17', ['as' => 'platform.catalog.oficial.apendice-17', 'uses' => 'CatalogController@appendixSeventeen']);
Route::get('catalogs/oficials/apendice-18', ['as' => 'platform.catalog.oficial.apendice-18', 'uses' => 'CatalogController@appendixEighteen']);
Route::get('catalogs/oficials/apendice-19', ['as' => 'platform.catalog.oficial.apendice-19', 'uses' => 'CatalogController@appendixNineteen']);
Route::get('catalogs/oficials/apendice-21', ['as' => 'platform.catalog.oficial.apendice-21', 'uses' => 'CatalogController@appendixTwentyone']);

Route::get('catalogs/oficials/oma-unidades', ['as' => 'platform.catalog.oficial.oma-unidades', 'uses' => 'CatalogController@omaUnits']);
Route::get('catalogs/oficials/oma-moneda', ['as' => 'platform.catalog.oficial.oma-moneda', 'uses' => 'CatalogController@omaCurrencies']);
Route::get('catalogs/oficials/oma-factor', ['as' => 'platform.catalog.oficial.oma-factor', 'uses' => 'CatalogController@omaFactor']);
Route::get('catalogs/oficials/oma-cambio', ['as' => 'platform.catalog.oficial.oma-cambio', 'uses' => 'CatalogController@omaChange']);
Route::get('catalogs/oficials/oma-inpc', ['as' => 'platform.catalog.oficial.oma-inpc', 'uses' => 'CatalogController@omaINPC']);
Route::get('catalogs/oficials/oma-fraccion', ['as' => 'platform.catalog.oficial.oma-fraccion', 'uses' => 'CatalogController@omaFraccion']);

Route::get('storage', ['as' => 'platform.storage.index', 'uses' => 'StorageController@index']);
Route::get('shop', ['as' => 'platform.shop.index', 'uses' => 'ShopController@index']);
