<?php

namespace App\Http\Controllers\Cove;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cove\ProviderRequest;
use App\Cove\Provider;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::all();
        $type = auth()->user()->permission_cove;

        return view('Cove.providers.index')->with(['providers' => $providers, 'type' => $type]);
    }

    public function create()
    {    
        return view('Cove.providers.create');
    }

    public function store(ProviderRequest $request)
    {
        $provider = new Provider;
        Provider::insertOrUpdate($provider, $request);

        return redirect()->route('cove.providers.index');
    }

    public function  edit(Provider $provider)
    {          
        return view('Cove.providers.edit')->with('provider', $provider);
    }

    public function update(Provider $provider, ProviderRequest $request)
    {
        Provider::insertOrUpdate($provider, $request);

        return redirect()->route('cove.providers.index');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();

        return response()->json(['redirect' => 'providers']);
    }
}