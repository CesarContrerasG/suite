<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/companies',function(){
     $companies = \App\Qore\Company::select('name as value', 'id as data')->get();
     return response()->json($companies);
});

Route::get('/companies/{id}',function($id){
     $company = \App\Qore\Company::find($id);
     return response()->json($company);
});


Route::get('/invoices/{contract}/services/{services}', function($contract, $services){
    $services = explode(',', $services);
    $results = \App\Qore\Details::join('products', 'contract_details.service_id', '=', 'products.id')
        ->select('contract_details.contract_price as price', 'products.name')
        ->whereIn('contract_details.service_id', $services)
        ->where('contract_details.contract_id', $contract)
        ->get();
    return response()->json($results);
});

Route::post('notification/viewed', function(Request $request){
    \App\Viewers::create($request->all());
    return response()->json('correcto');
});

Route::post('register-newsletter', ['as' => 'landing.register', 'uses' => 'WebController@registerToNewsletter']);
