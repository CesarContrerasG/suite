<?php


/*
|--------------------------------------------------------------------------
| Qore Administration Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('administration', ['as' => 'qore.administration', 'uses' => 'HomeController@admin']);
/* Sistmas */
Route::get('products', ['as' => 'qore.products.index', 'uses' => 'ProductsController@index']);
Route::get('products/create', ['as' => 'qore.products.create', 'uses' => 'ProductsController@create']);
Route::post('products/create', ['as' => 'qore.products.store', 'uses' => 'ProductsController@store']);
Route::get('products/{product}/edit', ['as' => 'qore.products.edit', 'uses' => 'ProductsController@edit']);
Route::put('products/{product}/edit', ['as' => 'qore.products.update', 'uses' => 'ProductsController@update']);
Route::delete('products/{product}/destroy', ['as' => 'qore.products.destroy', 'uses' => 'ProductsController@destroy']);
Route::get('products/{product}/disabled', ['as' => 'qore.products.disabled', 'uses' => 'ProductsController@disabled']);
Route::bind('product', function($product, $route){
    return \Hashids::decode($product);
});
/* Empresas */
Route::get('companies', ['as' => 'qore.companies.index', 'uses' => 'CompanyController@index']);
Route::get('companies/create', ['as' => 'qore.companies.create', 'uses' => 'CompanyController@create']);
Route::post('companies/create', ['as' => 'qore.companies.store', 'uses' => 'CompanyController@store']);
Route::get('companies/{company}/edit', ['as' => 'qore.companies.edit', 'uses' => 'CompanyController@edit']);
Route::put('companies/{company}/edit', ['as' => 'qore.companies.update', 'uses' => 'CompanyController@update']);
Route::delete('companies/{company}/destroy', ['as' => 'qore.companies.destroy', 'uses' => 'CompanyController@destroy']);
Route::get('companies/{company}/disabled', ['as' => 'qore.companies.disabled', 'uses' => 'CompanyController@disabled']);
/* Proveedores */
Route::get('providers', ['as' => 'qore.providers.index', 'uses' => 'ProvidersController@index']);
Route::get('providers/create', ['as' => 'qore.providers.create', 'uses' => 'ProvidersController@create']);
Route::post('providers/create', ['as' => 'qore.providers.store', 'uses' => 'ProvidersController@store']);
Route::get('providers/{company}/edit', ['as' => 'qore.providers.edit', 'uses' => 'ProvidersController@edit']);
Route::put('providers/{company}/edit', ['as' => 'qore.providers.update', 'uses' => 'ProvidersController@update']);
Route::delete('providers/{company}/destroy', ['as' => 'qore.providers.destroy', 'uses' => 'ProvidersController@destroy']);
Route::get('providers/{company}/disabled', ['as' => 'qore.providers.disabled', 'uses' => 'ProvidersController@disabled']);
/* Prospectos */
Route::get('prospects', ['as' => 'qore.prospects.index', 'uses' => 'ProspectController@index']);
Route::get('prospects/create', ['as' => 'qore.prospects.create', 'uses' => 'ProspectController@create']);
Route::post('prospects/create', ['as' => 'qore.prospects.store', 'uses' => 'ProspectController@store']);
Route::get('prospects/{company}/edit', ['as' => 'qore.prospects.edit', 'uses' => 'ProspectController@edit']);
Route::put('prospects/{company}/edit', ['as' => 'qore.prospects.update', 'uses' => 'ProspectController@update']);
Route::delete('prospects/{company}/destroy', ['as' => 'qore.prospects.destroy', 'uses' => 'ProspectController@destroy']);
Route::get('prospects/{company}/disabled', ['as' => 'qore.prospects.disabled', 'uses' => 'ProspectController@disabled']);
Route::bind('company', function($company, $route){
    return \Hashids::decode($company);
});
/* Departamentos */
Route::get('departaments', ['as' => 'qore.departaments.index', 'uses' => 'DepartamentsController@index']);
Route::get('departaments/create', ['as' => 'qore.departaments.create', 'uses' => 'DepartamentsController@create']);
Route::post('departaments/store', ['as' => 'qore.departaments.store', 'uses' => 'DepartamentsController@store']);
Route::get('departaments/{departament}/edit', ['as' => 'qore.departaments.edit', 'uses' => 'DepartamentsController@edit']);
Route::put('departaments/{departament}/edit', ['as' => 'qore.departaments.update', 'uses' => 'DepartamentsController@update']);
Route::delete('departaments/{departament}/destroy', ['as' => 'qore.departaments.destroy', 'uses' => 'DepartamentsController@destroy']);
Route::get('departaments/{departament}/destroy', ['as' => 'qore.departaments.disabled', 'uses' => 'DepartamentsController@disabled']);
Route::bind('departament', function($departament, $route){
    return \Hashids::decode($departament);
});
/* Usuarios */
Route::get('users', ['as' => 'qore.users.index', 'uses' => 'UserController@index']);
Route::get('users/create', ['as' => 'qore.users.create', 'uses' => 'UserController@create']);
Route::post('users/create', ['as' => 'qore.users.store', 'uses' => 'UserController@store']);
Route::get('users/{user}/edit', ['as' => 'qore.users.edit', 'uses' => 'UserController@edit']);
Route::put('users/{user}/edit', ['as' => 'qore.users.update', 'uses' => 'UserController@update']);
Route::delete('users/{user}/destroy', ['as' => 'qore.users.destroy', 'uses' => 'UserController@destroy']);
Route::get('users/{user}/disabled', ['as' => 'qore.users.disabled', 'uses' => 'UserController@disabled']);
Route::get('users/{user}/permissions', ['as' => 'qore.users.permissions', 'uses' => 'UserController@permissions']);
Route::post('users/{user}/permissions', ['as' => 'qore.users.privileges', 'uses' => 'UserController@privileges']);

Route::get('users/client/create', ['as' => 'qore.users.client.create', 'uses' => 'UserController@createClient']);
Route::get('users/client/{user}/edit', ['as' => 'qore.users.client.edit', 'uses' => 'UserController@editClient']);
Route::bind('user', function($user, $route){
    return \Hashids::decode($user);
});
/* Catalogos */
Route::get('catalogs', ['as' => 'qore.catalogs.index', 'uses' => 'CatalogController@index']);
/* Catalogo Aduana Sección*/
Route::get('catalogs/aduanas', ['as' => 'qore.catalogs.aduana.index', 'uses' => 'CatalogController@aduanas']);
Route::post('catalogs/aduanas', ['as' => 'qore.catalogs.aduana.store', 'uses' => 'CatalogController@aduanaStore']);
Route::get('catalogs/aduanas/{aduana}/edit', ['as' => 'qore.catalogs.aduana.edit', 'uses' => 'CatalogController@aduanaEdit']);
Route::put('catalogs/aduanas/{aduana}/edit', ['as' => 'qore.catalogs.aduana.update', 'uses' => 'CatalogController@aduanaUpdate']);
Route::delete('catalogs/aduanas/{aduana}/destroy', ['as' => 'qore.catalogs.aduana.destroy', 'uses' => 'CatalogController@aduanaDestroy']);
Route::get('catalogs/aduanas/export', ['as' => 'qore.catalogs.aduana.export', 'uses' => 'CatalogController@aduanaExport']);
Route::get('catalogs/aduanas/download-layout', ['as' => 'qore.catalogs.aduana.layout', 'uses' => 'CatalogController@aduanaDownload']);
Route::post('catalogs/aduanas/import', ['as' => 'qore.catalogs.aduana.import', 'uses' => 'CatalogController@aduanaImport']);
/* Catalogo Clave de Pedimento */
Route::get('catalogs/keys', ['as' => 'qore.catalogs.cpediments.index', 'uses' => 'CatalogController@cpediments']);
Route::post('catalogs/keys', ['as' => 'qore.catalogs.cpediments.store', 'uses' => 'CatalogController@cpedimentStore']);
Route::get('catalogs/keys/{cpedimento}/edit', ['as' => 'qore.catalogs.cpediments.edit', 'uses' => 'CatalogController@cpedimentEdit']);
Route::put('catalogs/keys/{cpedimento}/edit', ['as' => 'qore.catalogs.cpediments.update', 'uses' => 'CatalogController@cpedimentUpdate']);
Route::delete('catalogs/keys/{cpedimento}/destroy', ['as' => 'qore.catalogs.cpediments.destroy', 'uses' => 'CatalogController@cpedimentDestroy']);
Route::get('catalogs/keys/export', ['as' => 'qore.catalogs.cpediments.export', 'uses' => 'CatalogController@cpedimentExport']);
Route::get('catalog/keys/download-layout', ['as' => 'qore.catalogs.cpediments.layout', 'uses' => 'CatalogController@cpedimentDownload']);
Route::post('catalog/keys/import', ['as' => 'qore.catalogs.cpediments.import', 'uses' => 'CatalogController@cpedimentImport']);
/* Catalogo Medios de Transporte */
Route::get('catalogs/transports', ['as' => 'qore.catalogs.transports.index', 'uses' => 'CatalogController@transports']);
Route::post('catalogs/transports', ['as' => 'qore.catalogs.transports.store', 'uses' => 'CatalogController@transportStore']);
Route::get('catalogs/transports/{transport}/edit', ['as' => 'qore.catalogs.transports.edit', 'uses' => 'CatalogController@transportEdit']);
Route::put('catalogs/transports/{transport}/edit', ['as' => 'qore.catalogs.transports.update', 'uses' => 'CatalogController@transportUpdate']);
Route::delete('catalogs/transports/{transport}/destroy', ['as' => 'qore.catalogs.transports.destroy', 'uses' => 'CatalogController@transportDestroy']);
Route::get('catalogs/transports/export', ['as' => 'qore.catalogs.transports.export', 'uses' => 'CatalogController@transportsExport']);
Route::get('catalogs/transports/download-layout', ['as' => 'qore.catalogs.transports.layout', 'uses' => 'CatalogController@transportsDownload']);
Route::post('catalogs/transports/import', ['as' => 'qore.catalogs.transports.import', 'uses' => 'CatalogController@transportImport']);
/* Catalogo Clave de Paises */
Route::get('catalogs/countries', ['as' => 'qore.catalogs.countries.index', 'uses' => 'CatalogController@countries']);
Route::post('catalogs/countries', ['as' => 'qore.catalogs.countries.store', 'uses' => 'CatalogController@countryStore']);
Route::get('catalogs/countries/{country}/edit', ['as' => 'qore.catalogs.countries.edit', 'uses' => 'CatalogController@countryEdit']);
Route::put('catalogs/countries/{country}/edit', ['as' => 'qore.catalogs.countries.update', 'uses' => 'CatalogController@countryUpdate']);
Route::delete('catalogs/countries/{country}/destroy', ['as' => 'qore.catalogs.countries.destroy', 'uses' => 'CatalogController@countryDestroy']);
Route::get('catalogs/countries/export', ['as' => 'qore.catalogs.countries.export', 'uses' => 'CatalogController@countriesExport']);
Route::get('catalogs/countries/download-layout', ['as' => 'qore.catalogs.countries.layout', 'uses' => 'CatalogController@countriesDownload']);
Route::post('catalogs/countries/import', ['as' => 'qore.catalogs.countries.import', 'uses' => 'CatalogController@countriesImport']);
/* Catalogo Claves de Moneda */
Route::get('catalogs/currencies', ['as' => 'qore.catalogs.currencies.index', 'uses' => 'CatalogController@currencies']);
Route::post('catalogs/currencies', ['as' => 'qore.catalogs.currencies.store', 'uses' => 'CatalogController@currencyStore']);
Route::get('catalogs/currencies/{currency}/edit', ['as' => 'qore.catalogs.currencies.edit', 'uses' => 'CatalogController@currencyEdit']);
Route::put('catalogs/currencies/{currency}/edit', ['as' => 'qore.catalogs.currencies.update', 'uses' => 'CatalogController@currencyUpdate']);
Route::delete('catalogs/currencies/{currency}/destroy', ['as' => 'qore.catalogs.currencies.destroy', 'uses' => 'CatalogController@currencyDestroy']);
Route::get('catalogs/currencies/export', ['as' => 'qore.catalogs.currencies.export', 'uses' => 'CatalogController@currenciesExport']);
Route::get('catalogs/currencies/download-layout', ['as' => 'qore.catalogs.currencies.layout', 'uses' => 'CatalogController@currenciesDownload']);
Route::post('catalogs/currencies/import', ['as' => 'qore.catalogs.currencies.import', 'uses' => 'CatalogController@currenciesImport']);
/* Catalogo Recintos Fiscalizados */
Route::get('catalogs/enclosures', ['as' => 'qore.catalogs.enclosures.index', 'uses' => 'CatalogController@enclosures']);
Route::post('catalogs/enclosures', ['as' => 'qore.catalogs.enclosures.store', 'uses' => 'CatalogController@enclosureStore']);
Route::get('catalogs/enclosures/{enclosure}/edit', ['as' => 'qore.catalogs.enclosures.edit', 'uses' => 'CatalogController@enclosureEdit']);
Route::put('catalogs/enclosures/{enclosure}/edit', ['as' => 'qore.catalogs.enclosures.update', 'uses' => 'CatalogController@enclosureUpdate']);
Route::delete('catalogs/enclosures/{enclosure}/destroy', ['as' => 'qore.catalogs.enclosures.destroy', 'uses' => 'CatalogController@enclosureDestroy']);
Route::get('catalogs/enclosures/export', ['as' => 'qore.catalogs.enclosures.export', 'uses' => 'CatalogController@enclosuresExport']);
Route::get('catalogs/enclosures/download-layout', ['as' => 'qore.catalogs.enclosures.layout', 'uses' => 'CatalogController@enclosuresDownload']);
Route::post('catalogs/enclosures/import', ['as' => 'qore.catalogs.enclosures.import', 'uses' => 'CatalogController@enclosuresImport']);
/* Catalogo Unidades de Medida */
Route::get('catalogs/units', ['as' => 'qore.catalogs.units.index', 'uses' => 'CatalogController@units']);
Route::post('catalogs/units', ['as' => 'qore.catalogs.units.store', 'uses' => 'CatalogController@unitStore']);
Route::get('catalogs/units/{unit}/edit', ['as' => 'qore.catalogs.units.edit', 'uses' => 'CatalogController@unitEdit']);
Route::put('catalogs/units/{unit}/edit', ['as' => 'qore.catalogs.units.update', 'uses' => 'CatalogController@unitUpdate']);
Route::delete('catalogs/units/{unit}/destroy', ['as' => 'qore.catalogs.units.destroy', 'uses' => 'CatalogController@unitDestroy']);
Route::get('catalogs/units/export', ['as' => 'qore.catalogs.units.export', 'uses' => 'CatalogController@unitsExport']);
Route::get('catalogs/units/download-layout', ['as' => 'qore.catalogs.units.layout', 'uses' => 'CatalogController@unitsDownload']);
Route::post('catalogs/units/import', ['as' => 'qore.catalogs.units.import', 'uses' => 'CatalogController@unitsImport']);
/* Catalogo Identificadores */
Route::get('catalogs/identifiers', ['as' => 'qore.catalogs.identifiers.index', 'uses' => 'CatalogController@identifiers']);
Route::post('catalogs/identifiers', ['as' => 'qore.catalogs.identifiers.store', 'uses' => 'CatalogController@identifierStore']);
Route::get('catalogs/identifiers/{identifier}/edit', ['as' => 'qore.catalogs.identifiers.edit', 'uses' => 'CatalogController@identifierEdit']);
Route::put('catalogs/identifiers/{identifier}/edit', ['as' => 'qore.catalogs.identifiers.update', 'uses' => 'CatalogController@identifierUpdate']);
Route::delete('catalogs/identifiers/{identifier}/destroy', ['as' => 'qore.catalogs.identifiers.destroy', 'uses' => 'CatalogController@identifierDestroy']);
Route::get('catalogs/identifiers/export', ['as' => 'qore.catalogs.identifiers.export', 'uses' => 'CatalogController@identifiersExport']);
Route::get('catalogs/identifiers/download-layout', ['as' => 'qore.catalogs.identifiers.layout', 'uses' => 'CatalogController@identifiersDownload']);
Route::post('catalogs/identifiers/import', ['as' => 'qore.catalogs.identifiers.import', 'uses' => 'CatalogController@identifiersImport']);
/* Catalogo Regulaciones y Restricciones no Arancelarias */
Route::get('catalogs/regularizations', ['as' => 'qore.catalogs.regularizations.index', 'uses' => 'CatalogController@regularizations']);
Route::post('catalogs/regularizations', ['as' => 'qore.catalogs.regularizations.store', 'uses' => 'CatalogController@regularizationStore']);
Route::get('catalogs/regularizations/{regularization}/edit', ['as' => 'qore.catalogs.regularizations.edit', 'uses' => 'CatalogController@regularizationEdit']);
Route::put('catalogs/regularizations/{regularization}/edit', ['as' => 'qore.catalogs.regularizations.update', 'uses' => 'CatalogController@regularizationUpdate']);
Route::delete('catalogs/regularizations/{regularization}/destroy', ['as' => 'qore.catalogs.regularizations.destroy', 'uses' => 'CatalogController@regularizationDestroy']);
Route::get('catalogs/regularizations/export', ['as' => 'qore.catalogs.regularizations.export', 'uses' => 'CatalogController@regularizationsExport']);
Route::get('catalogs/regularizations/download-layout', ['as' => 'qore.catalogs.regularizations.layout', 'uses' => 'CatalogController@regularizationsDownload']);
Route::post('catalogs/regularizations/import', ['as' => 'qore.catalogs.regularizations.import', 'uses' => 'CatalogController@regularizationsImport']);
/* Catalogo Tipos de contenedores y vehiculos de autotransporte */
Route::get('catalogs/containers', ['as' => 'qore.catalogs.containers.index', 'uses' => 'CatalogController@containers']);
Route::post('catalogs/containers', ['as' => 'qore.catalogs.containers.store', 'uses' => 'CatalogController@containerStore']);
Route::get('catalogs/containers/{container}/edit', ['as' => 'qore.catalogs.containers.edit', 'uses' => 'CatalogController@containerEdit']);
Route::put('catalogs/containers/{container}/edit', ['as' => 'qore.catalogs.containers.update', 'uses' => 'CatalogController@containerUpdate']);
Route::delete('catalogs/containers/{container}/destroy', ['as' => 'qore.catalogs.containers.destroy', 'uses' => 'CatalogController@containerDestroy']);
Route::get('catalogs/containers/export', ['as' => 'qore.catalogs.containers.export', 'uses' => 'CatalogController@containersExport']);
Route::get('catalogs/containers/download-layout', ['as' => 'qore.catalogs.containers.layout', 'uses' => 'CatalogController@containersDownload']);
Route::post('catalogs/containers/import', ['as' => 'qore.catalogs.containers.import', 'uses' => 'CatalogController@containersImport']);
/* Catalogo claves de metodos de valoracion */
Route::get('catalogs/valuations', ['as' => 'qore.catalogs.valuations.index', 'uses' => 'CatalogController@valuations']);
Route::post('catalogs/valuations', ['as' => 'qore.catalogs.valuations.store', 'uses' => 'CatalogController@valuationStore']);
Route::get('catalogs/valuations/{valuation}/edit', ['as' => 'qore.catalogs.valuations.edit', 'uses' => 'CatalogController@valuationEdit']);
Route::put('catalogs/valuations/{valuation}/edit', ['as' => 'qore.catalogs.valuations.update', 'uses' => 'CatalogController@valuationUpdate']);
Route::delete('catalogs/valuations/{valuation}/destroy', ['as' => 'qore.catalogs.valuations.destroy', 'uses' => 'CatalogController@valuationDestroy']);
Route::get('catalogs/valuations/export', ['as' => 'qore.catalogs.valuations.export', 'uses' => 'CatalogController@valuationsExport']);
Route::get('catalogs/valuations/download-layout', ['as' => 'qore.catalogs.valuations.layout', 'uses' => 'CatalogController@valuationsDownload']);
Route::post('catalogs/valuations/import', ['as' => 'qore.catalogs.valuations.import', 'uses' => 'CatalogController@valuationsImport']);
/* Catalogo Contribuciones, Cuotas Compensatorias, Gravámenes y Derechos */
Route::get('catalogs/contributions', ['as' => 'qore.catalogs.contributions.index', 'uses' => 'CatalogController@contributions']);
Route::post('catalogs/contributions', ['as' => 'qore.catalogs.contributions.store', 'uses' => 'CatalogController@contributionStore']);
Route::get('catalogs/contributions/{contribution}/edit', ['as' => 'qore.catalogs.contributions.edit', 'uses' => 'CatalogController@contributionEdit']);
Route::put('catalogs/contributions/{contribution}/edit', ['as' => 'qore.catalogs.contributions.update', 'uses' => 'CatalogController@contributionUpdate']);
Route::delete('catalogs/contributions/{contribution}/destroy', ['as' => 'qore.catalogs.contributions.destroy', 'uses' => 'CatalogController@contributionDestroy']);
Route::get('catalogs/contributions/export', ['as' => 'qore.catalogs.contributions.export', 'uses' => 'CatalogController@contributionsExport']);
Route::get('catalogs/contributions/download-layout', ['as' => 'qore.catalogs.contributions.layout', 'uses' => 'CatalogController@contributionsDownload']);
Route::post('catalogs/contributions/import', ['as' => 'qore.catalogs.contributions.import', 'uses' => 'CatalogController@contributionsImport']);
/* Catalogo Forma de Pago */
Route::get('catalogs/payments', ['as' => 'qore.catalogs.payments.index', 'uses' => 'CatalogController@payments']);
Route::post('catalogs/payments', ['as' => 'qore.catalogs.payments.store', 'uses' => 'CatalogController@paymentStore']);
Route::get('catalogs/payments/{payment}/edit', ['as' => 'qore.catalogs.payments.edit', 'uses' => 'CatalogController@paymentEdit']);
Route::put('catalogs/payments/{payment}/edit', ['as' => 'qore.catalogs.payments.update', 'uses' => 'CatalogController@paymentUpdate']);
Route::delete('catalogs/payments/{payment}/destroy', ['as' => 'qore.catalogs.payments.destroy', 'uses' => 'CatalogController@paymentDestroy']);
Route::get('catalogs/payments/export', ['as' => 'qore.catalogs.payments.export', 'uses' => 'CatalogController@paymentsExport']);
Route::get('catalogs/payments/download-layout', ['as' => 'qore.catalogs.payments.layout', 'uses' => 'CatalogController@paymentsDownload']);
Route::post('catalogs/payments/import', ['as' => 'qore.catalogs.payments.import', 'uses' => 'CatalogController@paymentsImport']);
/* Terminos de Facturación */
Route::get('catalogs/billings', ['as' => 'qore.catalogs.billings.index', 'uses' => 'CatalogController@billings']);
Route::post('catalogs/billings', ['as' => 'qore.catalogs.billings.store', 'uses' => 'CatalogController@billingStore']);
Route::get('catalogs/billings/{billing}/edit', ['as' => 'qore.catalogs.billings.edit', 'uses' => 'CatalogController@billingEdit']);
Route::put('catalogs/billings/{billing}/edit', ['as' => 'qore.catalogs.billings.update', 'uses' => 'CatalogController@billingUpdate']);
Route::delete('catalogs/billings/{billing}/destroy', ['as' => 'qore.catalogs.billings.destroy', 'uses' => 'CatalogController@billingDestroy']);
Route::get('catalogs/billings/export', ['as' => 'qore.catalogs.billings.export', 'uses' => 'CatalogController@billingsExport']);
Route::get('catalogs/billings/download-layout', ['as' => 'qore.catalogs.billings.layout', 'uses' => 'CatalogController@billingsDownload']);
Route::post('catalogs/billings/import', ['as' => 'qore.catalogs.billings.import', 'uses' => 'CatalogController@billingsImport']);
/* Catalogo Destinos de Mercancia */
Route::get('catalogs/destinations', ['as' => 'qore.catalogs.destinations.index', 'uses' => 'CatalogController@destinations']);
Route::post('catalogs/destinations', ['as' => 'qore.catalogs.destinations.store', 'uses' => 'CatalogController@destinationStore']);
Route::get('catalogs/destinations/{destination}/edit', ['as' => 'qore.catalogs.destinations.edit', 'uses' => 'CatalogController@destinationEdit']);
Route::put('catalogs/destinations/{destination}/edit', ['as' => 'qore.catalogs.destinations.update', 'uses' => 'CatalogController@destinationUpdate']);
Route::delete('catalogs/destinations/{destination}/destroy', ['as' => 'qore.catalogs.destinations.destroy', 'uses' => 'CatalogController@destinationDestroy']);
Route::get('catalogs/destinations/export', ['as' => 'qore.catalogs.destinations.export', 'uses' => 'CatalogController@destinationsExport']);
Route::get('catalogs/destinations/download-layout', ['as' => 'qore.catalogs.destinations.layout', 'uses' => 'CatalogController@destinationsDownload']);
Route::post('catalogs/destinations/import', ['as' => 'qore.catalogs.destinations.import', 'uses' => 'CatalogController@destinationsImport']);
/* Catalogo Regimenes */
Route::get('catalogs/regimens', ['as' => 'qore.catalogs.regimens.index', 'uses' => 'CatalogController@regimens']);
Route::post('catalogs/regimens', ['as' => 'qore.catalogs.regimens.store', 'uses' => 'CatalogController@regimenStore']);
Route::get('catalogs/regimens/{regimen}/edit', ['as' => 'qore.catalogs.regimens.edit', 'uses' => 'CatalogController@regimenEdit']);
Route::put('catalogs/regimens/{regimen}/edit', ['as' => 'qore.catalogs.regimens.update', 'uses' => 'CatalogController@regimenUpdate']);
Route::delete('catalogs/regimens/{regimen}/destroy', ['as' => 'qore.catalogs.regimens.destroy', 'uses' => 'CatalogController@regimenDestroy']);
Route::get('catalogs/regimens/export', ['as' => 'qore.catalogs.regimens.export', 'uses' => 'CatalogController@regimensExport']);
Route::get('catalogs/regimens/download-layout', ['as' => 'qore.catalogs.regimens.layout', 'uses' => 'CatalogController@regimensDownload']);
Route::post('catalogs/regimens/import', ['as' => 'qore.catalogs.regimens.import', 'uses' => 'CatalogController@regimensImport']);
/* Catalogo Pedimentos y Consolidados */
Route::get('catalogs/consolids', ['as' => 'qore.catalogs.consolids.index', 'uses' => 'CatalogController@consolids']);
Route::post('catalogs/consolids', ['as' => 'qore.catalogs.consolids.store', 'uses' => 'CatalogController@consolidStore']);
Route::get('catalogs/consolids/{consolid}/edit', ['as' => 'qore.catalogs.consolids.edit', 'uses' => 'CatalogController@consolidEdit']);
Route::put('catalogs/consolids/{consolid}/edit', ['as' => 'qore.catalogs.consolids.update', 'uses' => 'CatalogController@consolidUpdate']);
Route::delete('catalogs/consolids/{consolid}/destroy', ['as' => 'qore.catalogs.consolids.destroy', 'uses' => 'CatalogController@consolidDestroy']);
Route::get('catalogs/consolids/export', ['as' => 'qore.catalogs.consolids.export', 'uses' => 'CatalogController@consolidsExport']);
Route::get('catalogs/consolids/download-layout', ['as' => 'qore.catalogs.consolids.layout', 'uses' => 'CatalogController@consolidsDownload']);
Route::post('catalogs/consolids/import', ['as' => 'qore.catalogs.consolids.import', 'uses' => 'CatalogController@consolidsImport']);
/* Catalogos tipos de tasas */
Route::get('catalogs/rates', ['as' => 'qore.catalogs.rates.index', 'uses' => 'CatalogController@rates']);
Route::post('catalogs/rates', ['as' => 'qore.catalogs.rates.store', 'uses' => 'CatalogController@rateStore']);
Route::get('catalogs/rates/{rate}/edit', ['as' => 'qore.catalogs.rates.edit', 'uses' => 'CatalogController@rateEdit']);
Route::put('catalogs/rates/{rate}/edit', ['as' => 'qore.catalogs.rates.update', 'uses' => 'CatalogController@rateUpdate']);
Route::delete('catalogs/rates/{rate}/destroy', ['as' => 'qore.catalogs.rates.destroy', 'uses' => 'CatalogController@rateDestroy']);
Route::get('catalogs/rates/export', ['as' => 'qore.catalogs.rates.export', 'uses' => 'CatalogController@ratesExport']);
Route::get('catalogs/rates/download-layout', ['as' => 'qore.catalogs.rates.layout', 'uses' => 'CatalogController@ratesDownload']);
Route::post('catalogs/rates/import', ['as' => 'qore.catalogs.rates.import', 'uses' => 'CatalogController@ratesImport']);
/* Catalogo Clasificación de Sustancias */
Route::get('catalogs/substances', ['as' => 'qore.catalogs.substances.index', 'uses' => 'CatalogController@substances']);
Route::post('catalogs/substances', ['as' => 'qore.catalogs.substances.store', 'uses' => 'CatalogController@substanceStore']);
Route::get('catalogs/substances/{substance}/edit', ['as' => 'qore.catalogs.substances.edit', 'uses' => 'CatalogController@substanceEdit']);
Route::put('catalogs/substances/{substance}/edit', ['as' => 'qore.catalogs.substances.update', 'uses' => 'CatalogController@substanceUpdate']);
Route::delete('catalogs/substances/{substance}/destroy', ['as' => 'qore.catalogs.substances.destroy', 'uses' => 'CatalogController@substanceDestroy']);
Route::get('catalogs/substances/export', ['as' => 'qore.catalogs.substances.export', 'uses' => 'CatalogController@substancesExport']);
Route::get('catalogs/substances/download-layout', ['as' => 'qore.catalogs.substances.layout', 'uses' => 'CatalogController@substancesDownload']);
Route::post('catalogs/substances/import', ['as' => 'qore.catalogs.substances.import', 'uses' => 'CatalogController@substancesImport']);
/* Catalogo Recintos Fiscallizados Estrategicos */
Route::get('catalogs/strategics', ['as' => 'qore.catalogs.strategics.index', 'uses' => 'CatalogController@strategics']);
Route::post('catalogs/strategics', ['as' => 'qore.catalogs.strategics.store', 'uses' => 'CatalogController@strategicStore']);
Route::get('catalogs/strategics/{strategic}/edit', ['as' => 'qore.catalogs.strategics.edit', 'uses' => 'CatalogController@strategicEdit']);
Route::put('catalogs/strategics/{strategic}/edit', ['as' => 'qore.catalogs.strategics.update', 'uses' => 'CatalogController@strategicUpdate']);
Route::delete('catalogs/strategics/{strategic}/destroy', ['as' => 'qore.catalogs.strategics.destroy', 'uses' => 'CatalogController@strategicDestroy']);
Route::get('catalogs/strategics/export', ['as' => 'qore.catalogs.strategics.export', 'uses' => 'CatalogController@strategicsExport']);
Route::get('catalogs/strategics/download-layout', ['as' => 'qore.catalogs.strategics.layout', 'uses' => 'CatalogController@strategicsDownload']);
Route::post('catalogs/strategics/import', ['as' => 'qore.catalogs.strategics.import', 'uses' => 'CatalogController@strategicsImport']);
/* OMA Unidades de Medida */
Route::get('catalogs/omaunits', ['as' => 'qore.catalogs.omaunits.index', 'uses' => 'CatalogController@omaunits']);
Route::post('catalogs/omaunits', ['as' => 'qore.catalogs.omaunits.store', 'uses' => 'CatalogController@omaunitStore']);
Route::get('catalogs/omaunits/{omaunit}/edit', ['as' => 'qore.catalogs.omaunits.edit', 'uses' => 'CatalogController@omaunitEdit']);
Route::put('catalogs/omaunits/{omaunit}/edit', ['as' => 'qore.catalogs.omaunits.update', 'uses' => 'CatalogController@omaunitUpdate']);
Route::delete('catalogs/omaunits/{omaunit}/destroy', ['as' => 'qore.catalogs.omaunits.destroy', 'uses' => 'CatalogController@omaunitDestroy']);
Route::get('catalogs/omaunits/export', ['as' => 'qore.catalogs.omaunits.export', 'uses' => 'CatalogController@omaunitsExport']);
Route::get('catalogs/omaunits/download-layout', ['as' => 'qore.catalogs.omaunits.layout', 'uses' => 'CatalogController@omaunitsDownload']);
Route::post('catalogs/omaunits/import', ['as' => 'qore.catalogs.omaunits.import', 'uses' => 'CatalogController@omaunitsImport']);
/* OMA Claves de Monedas */
Route::get('catalogs/omacurrencies', ['as' => 'qore.catalogs.omacurrencies.index', 'uses' => 'CatalogController@omacurrencies']);
Route::post('catalogs/omacurrencies', ['as' => 'qore.catalogs.omacurrencies.store', 'uses' => 'CatalogController@omacurrencyStore']);
Route::get('catalogs/omacurrencies/{omacurrency}/edit', ['as' => 'qore.catalogs.omacurrencies.edit', 'uses' => 'CatalogController@omacurrencyEdit']);
Route::put('catalogs/omacurrencies/{omacurrency}/edit', ['as' => 'qore.catalogs.omacurrencies.update', 'uses' => 'CatalogController@omacurrencyUpdate']);
Route::delete('catalogs/omacurrencies/{omacurrency}/destroy', ['as' => 'qore.catalogs.omacurrencies.destroy', 'uses' => 'CatalogController@omacurrencyDestroy']);
Route::get('catalogs/omacurrencies/export', ['as' => 'qore.catalogs.omacurrencies.export', 'uses' => 'CatalogController@omacurrenciesExport']);
Route::get('catalogs/omacurrencies/download-layout', ['as' => 'qore.catalogs.omacurrencies.layout', 'uses' => 'CatalogController@omacurrenciesDownload']);
Route::post('catalogs/omacurrencies/import', ['as' => 'qore.catalogs.omacurrencies.import', 'uses' => 'CatalogController@omacurrenciesImport']);
/* OMA Claves de Monedas */
Route::get('catalogs/factors', ['as' => 'qore.catalogs.factors.index', 'uses' => 'CatalogController@factors']);
Route::post('catalogs/factors', ['as' => 'qore.catalogs.factors.store', 'uses' => 'CatalogController@factorStore']);
Route::get('catalogs/factors/{factor}/edit', ['as' => 'qore.catalogs.factors.edit', 'uses' => 'CatalogController@factorEdit']);
Route::put('catalogs/factors/{factor}/edit', ['as' => 'qore.catalogs.factors.update', 'uses' => 'CatalogController@factorUpdate']);
Route::delete('catalogs/factors/{factor}/destroy', ['as' => 'qore.catalogs.factors.destroy', 'uses' => 'CatalogController@factorDestroy']);
Route::get('catalogs/factors/export', ['as' => 'qore.catalogs.factors.export', 'uses' => 'CatalogController@factorsExport']);
Route::get('catalogs/factors/download-layout', ['as' => 'qore.catalogs.factors.layout', 'uses' => 'CatalogController@factorsDownload']);
Route::post('catalogs/factors/import', ['as' => 'qore.catalogs.factors.import', 'uses' => 'CatalogController@factorsImport']);
/* OMA Tipo de Cambio */
Route::get('catalogs/changes', ['as' => 'qore.catalogs.changes.index', 'uses' => 'CatalogController@changes']);
Route::post('catalogs/changes', ['as' => 'qore.catalogs.changes.store', 'uses' => 'CatalogController@changeStore']);
Route::get('catalogs/changes/{change}/edit', ['as' => 'qore.catalogs.changes.edit', 'uses' => 'CatalogController@changeEdit']);
Route::put('catalogs/changes/{change}/edit', ['as' => 'qore.catalogs.changes.update', 'uses' => 'CatalogController@changeUpdate']);
Route::delete('catalogs/changes/{change}/destroy', ['as' => 'qore.catalogs.changes.destroy', 'uses' => 'CatalogController@changeDestroy']);
Route::get('catalogs/changes/export', ['as' => 'qore.catalogs.changes.export', 'uses' => 'CatalogController@changesExport']);
Route::get('catalogs/changes/download-layout', ['as' => 'qore.catalogs.changes.layout', 'uses' => 'CatalogController@changesDownload']);
Route::post('catalogs/changes/import', ['as' => 'qore.catalogs.changes.import', 'uses' => 'CatalogController@changesImport']);
/* Indice Nacional del Precio al Consumidor*/
Route::get('catalogs/inpc', ['as' => 'qore.catalogs.inpc.index', 'uses' => 'CatalogController@inpc']);
Route::post('catalogs/inpc', ['as' => 'qore.catalogs.inpc.store', 'uses' => 'CatalogController@inpcStore']);
Route::get('catalogs/inpc/{inpc}/edit', ['as' => 'qore.catalogs.inpc.edit', 'uses' => 'CatalogController@inpcEdit']);
Route::put('catalogs/inpc/{inpc}/edit', ['as' => 'qore.catalogs.inpc.update', 'uses' => 'CatalogController@inpcUpdate']);
Route::delete('catalogs/inpc/{inpc}/destroy', ['as' => 'qore.catalogs.inpc.destroy', 'uses' => 'CatalogController@inpcDestroy']);
Route::get('catalogs/inpc/export', ['as' => 'qore.catalogs.inpc.export', 'uses' => 'CatalogController@inpcExport']);
Route::get('catalogs/inpc/download-layout', ['as' => 'qore.catalogs.inpc.layout', 'uses' => 'CatalogController@inpcDownload']);
Route::post('catalogs/inpc/import', ['as' => 'qore.catalogs.inpc.import', 'uses' => 'CatalogController@inpcImport']);
/* Catalogo OMA Fraccion Arancelaria */
Route::get('catalogs/fractions', ['as' => 'qore.catalogs.fractions.index', 'uses' => 'CatalogController@fractions']);
Route::post('catalogs/fractions', ['as' => 'qore.catalogs.fractions.store', 'uses' => 'CatalogController@fractionStore']);
Route::get('catalogs/fractions/{fraction}/edit', ['as' => 'qore.catalogs.fractions.edit', 'uses' => 'CatalogController@fractionEdit']);
Route::put('catalogs/fractions/{fraction}/edit', ['as' => 'qore.catalogs.fractions.update', 'uses' => 'CatalogController@fractionUpdate']);
Route::delete('catalogs/fractions/{fraction}/destroy', ['as' => 'qore.catalogs.fractions.destroy', 'uses' => 'CatalogController@fractionDestroy']);
Route::get('catalogs/fractions/export', ['as' => 'qore.catalogs.fractions.export', 'uses' => 'CatalogController@fractionsExport']);
Route::get('catalogs/fractions/download-layout', ['as' => 'qore.catalogs.fractions.layout', 'uses' => 'CatalogController@fractionsDownload']);
Route::post('catalogs/fractions/import', ['as' => 'qore.catalogs.fractions.import', 'uses' => 'CatalogController@fractionsImport']);


/*
|--------------------------------------------------------------------------
| Qore Accounts Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('accounts', ['as' => 'qore.accounts', 'uses' => 'HomeController@accounts']);

Route::get('contracts/', ['as' => 'qore.contracts.index', 'uses' => 'ContractsController@index']);
Route::get('contracts/create', ['as' => 'qore.contracts.create', 'uses' => 'ContractsController@create']);
Route::post('contracts/create', ['as' => 'qore.contracts.store', 'uses' => 'ContractsController@store']);
Route::get('contracts/{contract}/edit', ['as' => 'qore.contracts.edit', 'uses' => 'ContractsController@edit']);
Route::put('contracts/{contract}/edit', ['as' => 'qore.contracts.update', 'uses' => 'ContractsController@update']);
Route::delete('contracts/{contract}/destroy', ['as' => 'qore.contracts.destroy', 'uses' => 'ContractsController@destroy']);
Route::bind('contract', function($contract, $route){
    return \Hashids::decode($contract);
});

Route::get('receivables', ['as' => 'qore.receivables.index', 'uses' => 'AccountsController@index']);
Route::get('receivables/{contract}/invoices', ['as' => 'qore.receivable.invoices.index', 'uses' => 'AccountsController@invoices']);
Route::post('receivables/{contract}/invoices', ['as' => 'qore.receivable.invoices.store', 'uses' => 'AccountsController@invoicesStore']);
Route::get('receivables/invoices/{invoice}/pdf', ['as' => 'qore.receivables.invoices.pdf', 'uses' => 'AccountsController@invoicePDF']);
Route::get('receivables/invoices/{invoice}/xml', ['as' => 'qore.receivables.invoices.xml', 'uses' => 'AccountsController@invoiceXML']);

Route::get('receivables/{contract}/files', ['as' => 'qore.receivables.files.index', 'uses' => 'AccountsController@files']);
Route::post('receivables/{contract}/files', ['as' => 'qore.receivables.files.store', 'uses' => 'AccountsController@filesStore']);
Route::get('receivables/files/{file}/download', ['as' => 'qore.receivables.files.download', 'uses' => 'AccountsController@fileDownload']);

Route::get('receivables/{invoice}/payments', ['as' => 'qore.receivable.payments.index', 'uses' => 'AccountsController@payments']);
Route::post('receivables/{invoice}/payments', ['as' => 'qore.receivable.payments.store', 'uses' => 'AccountsController@paymentsStore']);
Route::get('receivables/payments/{pay}/pdf', ['as' => 'qore.receivables.payment.pdf', 'uses' => 'AccountsController@paymentPDF']);

Route::get('accounting-records', ['as' => 'qore.accounting.index', 'uses' => 'AccountingController@index']);
Route::get('accounting-records/create', ['as' => 'qore.accounting.create', 'uses' => 'AccountingController@create']);
Route::post('accounting-records/create', ['as' => 'qore.accounting.store', 'uses' => 'AccountingController@store']);
Route::get('accounting-records/{record}/show', ['as' => 'qore.accounting.show', 'uses' => 'AccountingController@show']);
Route::get('accounting-records/{record}/edit', ['as' => 'qore.accounting.edit', 'uses' => 'AccountingController@edit']);
Route::put('accounting-records/{record}/edit', ['as' => 'qore.accounting.update', 'uses' => 'AccountingController@update']);
Route::delete('accounting-records/{record}/destroy', ['as' => 'qore.accounting.destroy', 'uses' => 'AccountingController@destroy']);
Route::get('accounting-records/accounting', ['as' => 'qore.accounting.report', 'uses' => 'AccountingController@report']);

Route::get('accounting-history', ['as' => 'qore.history.index', 'uses' => 'AccountsController@history']);
Route::get('invoice-history', ['as' => 'qore.history.invoices', 'uses' => 'AccountsController@invoiceHistory']);
Route::get('payment-history', ['as' => 'qore.history.payment', 'uses' => 'AccountsController@paymentHistory']);

/*
|--------------------------------------------------------------------------
| Qore Aplications Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('applications', ['as' => 'qore.applications', 'uses' => 'ApplicationController@index']);
Route::get('associate-with-companies', ['as' => 'qore.applications.associate', 'uses' => 'ApplicationController@associate']);
Route::post('associate-with-company/{company}', ['as' => 'qore.applications.active', 'uses' => 'ApplicationController@active']);
Route::get('associate-with-user/{user}', ['as' => 'qore.applications.users.associate', 'uses' => 'ApplicationController@applicationsUsers']);
Route::post('associate-with-user/{user}', ['as' => 'qore.applications.users.active', 'uses' => 'ApplicationController@applicationsPermissions']);

/*
|--------------------------------------------------------------------------
| Qore Analitycs Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'qore.home', 'uses' => 'HomeController@index']);
