<?php 

/*
=========================================== Rutas Catalagos ===============================================================
*/
Route::get('coves', ['as' => 'cove.view', 'uses' => 'CoveController@getCoves']);
Route::get('catalogs', ['as' => 'cove.catalogs.index', 'uses' => 'HomeController@catalogs']);
Route::get('company', ['as' => 'cove.company.index', 'uses' => 'CompanyController@index']);
Route::put('company/{company}', ['as' => 'cove.company.update', 'uses' => 'CompanyController@update']);
Route::post('company/create', ['as' => 'cove.company.store', 'uses' => 'CompanyController@store']);

Route::put('seal/{seal}', ['as' => 'cove.seal.update', 'uses' => 'SealController@update']);
Route::post('seal/create', ['as' => 'cove.seal.store', 'uses' => 'SealController@store']);

Route::get('materials', ['as' => 'cove.materials.index', 'uses' => 'MaterialController@index']);
Route::get('materials/create', ['as' => 'cove.materials.create', 'uses' => 'MaterialController@create']);
Route::post('materials/create', ['as' => 'cove.materials.store', 'uses' => 'MaterialController@store']);
Route::get('materials/{material}/edit', ['as' => 'cove.materials.edit', 'uses' => 'MaterialController@edit']);
Route::put('materials/{material}', ['as' => 'cove.materials.update', 'uses' => 'MaterialController@update']);
Route::delete('materials/{material}/destroy', ['as' => 'cove.materials.destroy', 'uses' => 'MaterialController@destroy']);
Route::get('materials/view', ['as' => 'cove.materials.view', 'uses' => 'MaterialController@getMaterials']);
Route::get('products', ['as' => 'cove.products.index', 'uses' => 'ProductController@index']);
Route::get('products/create', ['as' => 'cove.products.create', 'uses' => 'ProductController@create']);
Route::post('products/create', ['as' => 'cove.products.store', 'uses' => 'ProductController@store']);
Route::get('products/{product_cove}/edit', ['as' => 'cove.products.edit', 'uses' => 'ProductController@edit']);
Route::put('products/{product_cove}', ['as' => 'cove.products.update', 'uses' => 'ProductController@update']);
Route::delete('products/{product_cove}/destroy', ['as' => 'cove.products.destroy', 'uses' => 'ProductController@destroy']);
Route::get('assets', ['as' => 'cove.assets.index', 'uses' => 'AssetController@index']);
Route::get('assets/create', ['as' => 'cove.assets.create', 'uses' => 'AssetController@create']);
Route::post('assets/create', ['as' => 'cove.assets.store', 'uses' => 'AssetController@store']);
Route::get('assets/{asset}/edit', ['as' => 'cove.assets.edit', 'uses' => 'AssetController@edit']);
Route::put('assets/{asset}', ['as' => 'cove.assets.update', 'uses' => 'AssetController@update']);
Route::delete('assets/{asset}/destroy', ['as' => 'cove.assets.destroy', 'uses' => 'AssetController@destroy']);
Route::get('providers', ['as' => 'cove.providers.index', 'uses' => 'ProviderController@index']);
Route::get('providers/create', ['as' => 'cove.providers.create', 'uses' => 'ProviderController@create']);
Route::post('providers/create', ['as' => 'cove.providers.store', 'uses' => 'ProviderController@store']);
Route::get('providers/{provider}/edit', ['as' => 'cove.providers.edit', 'uses' => 'ProviderController@edit']);
Route::put('providers/{provider}', ['as' => 'cove.providers.update', 'uses' => 'ProviderController@update']);
Route::delete('providers/{provider}/destroy', ['as' => 'cove.providers.destroy', 'uses' => 'ProviderController@destroy']);
Route::get('customers', ['as' => 'cove.customers.index', 'uses' => 'CustomerController@index']);
Route::get('customers/create', ['as' => 'cove.customers.create', 'uses' => 'CustomerController@create']);
Route::post('customers/create', ['as' => 'cove.customers.store', 'uses' => 'CustomerController@store']);
Route::get('customers/{customer}/edit', ['as' => 'cove.customers.edit', 'uses' => 'CustomerController@edit']);
Route::put('customers/{customer}', ['as' => 'cove.customers.update', 'uses' => 'CustomerController@update']);
Route::delete('customers/{customer}/destroy', ['as' => 'cove.customers.destroy', 'uses' => 'CustomerController@destroy']);
Route::get('consultations', ['as' => 'cove.consultations.index', 'uses' => 'ConsultationController@index']);
Route::get('consultations/create', ['as' => 'cove.consultations.create', 'uses' => 'ConsultationController@create']);
Route::post('consultations/create', ['as' => 'cove.consultations.store', 'uses' => 'ConsultationController@store']);
Route::get('consultations/{consultation}/edit', ['as' => 'cove.consultations.edit', 'uses' => 'ConsultationController@edit']);
Route::put('consultations/{consultation}', ['as' => 'cove.consultations.update', 'uses' => 'ConsultationController@update']);
Route::delete('consultations/{consultation}/destroy', ['as' => 'cove.consultations.destroy', 'uses' => 'ConsultationController@destroy']);
Route::get('patents', ['as' => 'cove.patents.index', 'uses' => 'PatentController@index']);
Route::get('patents/create', ['as' => 'cove.patents.create', 'uses' => 'PatentController@create']);
Route::post('patents/create', ['as' => 'cove.patents.store', 'uses' => 'PatentController@store']);
Route::get('patents/{patent}/edit', ['as' => 'cove.patents.edit', 'uses' => 'PatentController@edit']);
Route::put('patents/{patent}', ['as' => 'cove.patents.update', 'uses' => 'PatentController@update']);
Route::delete('patents/{patent}/destroy', ['as' => 'cove.patents.destroy', 'uses' => 'PatentController@destroy']);

/*
=========================================== Rutas Operaciones  ===============================================================
*/
Route::get('reports', ['as' => 'cove.reports.index', 'uses' => 'HomeController@reports']);
Route::post('reports', ['as' => 'cove.reports.search', 'uses' => 'HomeController@reports']);

Route::get('operations', ['as' => 'cove.operations.index', 'uses' => 'HomeController@operations']);
Route::get('administration', ['as' => 'cove.administration.index', 'uses' => 'CoveController@index']);
Route::get('create', ['as' => 'cove.create', 'uses' => 'CoveController@create']);
Route::post('administration', ['as' => 'cove.store', 'uses' => 'CoveController@store']);
Route::get('administration/{cove}/edit', ['as' => 'cove.edit', 'uses' => 'CoveController@edit']);
Route::get('administration/{cove}', ['as' => 'cove.show', 'uses' => 'CoveController@show']);
Route::put('administration/{cove}/edit', ['as' => 'cove.update', 'uses' => 'CoveController@update']);
Route::delete('{cove}/destroy', ['uses' => 'CoveController@destroy']);
Route::get('administration/{cove}/sign/{all}', ['as' => 'cove.sign', 'uses' => 'CoveController@sign']);
Route::get('administration/acuse/{acuse}', ['as' => 'cove.acuse', 'uses' => 'CoveController@acuse']);
Route::get('administration/{cove}/download', ['as' => 'cove.download', 'uses' => 'CoveController@download']);
Route::get('administration/{cove}/digital', ['as' => 'cove.digital', 'uses' => 'DigitalController@show']);

Route::post('digital', ['as' => 'cove.digital.store', 'uses' => 'DigitalController@store']);
Route::get('digital/{digital}/view', ['as' => 'cove.digital.view', 'uses' => 'DigitalController@view']);
Route::get('digital/{digital}/sign/{all}', ['as' => 'cove.digital.sign', 'uses' => 'DigitalController@sign']);
Route::get('digital/acuse/{acuse}', ['as' => 'cove.digital.acuse', 'uses' => 'DigitalController@acuse']);

Route::delete('administration/digital/{digital}/destroy', ['uses' => 'DigitalController@destroy']);

Route::post('invoices', ['as' => 'cove.invoices.store', 'uses' => 'InvoiceController@store']);
Route::delete('invoices/{invoice}/destroy', ['uses' => 'InvoiceController@destroy']);
Route::post('transmitter', ['as' => 'cove.invoices.transmitter', 'uses' => 'InvoiceController@transmitter']);
Route::post('receiver', ['as' => 'cove.invoices.receiver', 'uses' => 'InvoiceController@receiver']);
Route::get('invoices/{invoice}', ['uses' => 'InvoiceController@show']);
Route::post('invoice/description', ['uses' => 'InvoiceController@description']);
Route::get('invoice/print/{cove}/{type}', ['as' => 'cove.invoices.print', 'uses' => 'InvoiceController@view']);

Route::post('inventory', ['as' => 'cove.inventory.store', 'uses' => 'InventoryController@store']);
Route::get('inventory/{inventory}', ['uses' => 'InventoryController@show']);
Route::delete('inventory/{inventory}/destroy', ['uses' => 'InventoryController@destroy']);
Route::post('inventory/secuencial', ['uses' => 'InventoryController@change']);
Route::post('inventory/upload', ['as' => 'cove.inventory.upload', 'uses' => 'InventoryController@upload']);
Route::post('detail', ['as' => 'cove.detail.store', 'uses' => 'DetailController@store']);
Route::put('detail/{detail}', ['as' => 'cove.detail.update', 'uses' => 'DetailController@update']);

Route::get('dashboard', ['as' => 'cove.dashboard.index', 'uses' => 'HomeController@dashboard']);
Route::get('test', function(){
    return "Esta prueba esta bien !!";
});
Route::get('/{id}', ['as' => 'cove.home', 'uses' => 'HomeController@index']);